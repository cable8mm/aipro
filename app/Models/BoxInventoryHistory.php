<?php

namespace App\Models;

use App\Enums\InventoryHistoryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class BoxInventoryHistory extends Model
{
    protected $with = ['box'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => InventoryHistoryType::class,
            'quantity' => 'integer',
            'model' => 'string',
            'attribute' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxInventoryHistory $boxInventoryHistory) {
            $boxInventoryHistory->author_id = $boxInventoryHistory->author_id ?? Auth::user()->id ?? null;
        });
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function cancel(): BelongsTo
    {
        return $this->belongsTo(BoxInventoryHistory::class, 'cancel_id');
    }

    /**
     * Get the parent inventoryHistoryable model (box_purchase_orders or ...).
     *
     * @see \App\Models\BoxPurchaseOrderItem
     * @see \App\Models\Order
     */
    public function historyable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Create a new transaction for cancelling a transaction
     *
     * @throws RuntimeException When transaction is canceled it cannot be completed
     */
    public function cancelling()
    {
        if ($this->cannotCancelling()) {
            throw new RuntimeException(__('Cannot cancel because it already canceled'));
        }

        $replicate = $this->replicate();

        $cancelBoxInventoryHistory = $replicate->box->plusminus(
            $replicate->quantity * -1,
            $replicate->historyable_type,
            $replicate->historyable_id,
            $this->id
        );

        $this->cancel_id = $cancelBoxInventoryHistory->id;

        $this->save();
    }

    public function canCancelling(): bool
    {
        return self::where('cancel_id', $this->id)->doesntExist();
    }

    public function cannotCancelling(): bool
    {
        return ! $this->canCancelling();
    }
}
