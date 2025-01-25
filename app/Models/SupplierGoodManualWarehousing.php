<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class SupplierGoodManualWarehousing extends Model
{
    use Actionable, HasFactory;

    protected $with = ['supplierGood', 'author'];

    protected function casts(): array
    {
        return [
            'supplier_good_id' => 'integer',
            'author_id' => 'integer',
            'manual_add_inventory_count' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (SupplierGoodManualWarehousing $supplierGoodManualWarehousing) {
            $supplierGoodManualWarehousing->author_id = $supplierGoodManualWarehousing->author_id ?? Auth::user()->id;
        });
    }

    public function supplierGood(): BelongsTo
    {
        return $this->belongsTo(SupplierGood::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
