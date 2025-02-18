<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class SupplierItemManualWarehousing extends Model
{
    use Actionable, HasFactory;

    protected $with = ['supplierItem', 'author'];

    protected function casts(): array
    {
        return [
            'supplier_item_id' => 'integer',
            'author_id' => 'integer',
            'manual_add_inventory_count' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (SupplierItemManualWarehousing $supplierItemManualWarehousing) {
            $supplierItemManualWarehousing->author_id = $supplierItemManualWarehousing->author_id ?? Auth::user()->id;
        });
    }

    public function supplierItem(): BelongsTo
    {
        return $this->belongsTo(SupplierItem::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
