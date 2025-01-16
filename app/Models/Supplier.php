<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

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

    public function supplierGoods(): HasMany
    {
        return $this->hasMany(SupplierGood::class);
    }
}
