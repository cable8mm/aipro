<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class Box extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'code' => 'string',
            'size' => 'integer',
            'delivery_price' => 'integer',
            'box_price' => 'integer',
            'inventory' => 'integer',
            'memo' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Box $box) {
            $box->author_id = $box->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function purchaseOrderBoxes(): HasMany
    {
        return $this->hasMany(PurchaseOrderBox::class);
    }

    public function boxInventoryHistories(): HasMany
    {
        return $this->hasMany(BoxInventoryHistory::class);
    }

    /**
     * Update inventory.
     *
     * @param  int  $inventory  Box's inventory amount
     * @param string caller model::class name
     * @param  int  $attribute  caller's attribute
     * @return mixed On success Model::$data if its not empty or true, false on failure
     */
    public function plusminus(int $inventory, string $model, int $attribute)
    {
        $this->inventory += $inventory;

        $this->save();

        $type = $inventory > 0 ? __('Receiving') : __('Shipping');

        return $this->boxInventoryHistories()->create([
            'box_id' => $this->id,
            'type' => $type,
            'quantity' => $inventory,
            'model' => $model,
            'attribute' => $attribute,
            'is_success' => true,
        ]);
    }
}
