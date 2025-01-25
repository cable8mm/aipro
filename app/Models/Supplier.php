<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class Supplier extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'ordered_email' => 'string',
            'contact_name' => 'string',
            'contact_tel' => 'string',
            'contact_cel' => 'string',
            'order_method' => 'array',
            'min_order_price' => 'integer',
            'is_information_manual_sync' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Supplier $supplier) {
            $supplier->author_id = $supplier->author_id ?? Auth::user()->id;
        });
    }

    public function supplierGoods(): HasMany
    {
        return $this->hasMany(SupplierGood::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
