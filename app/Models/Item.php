<?php

namespace App\Models;

use App\Enums\InventoryHistory as EnumInventoryHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class Item extends Model
{
    use Actionable, HasFactory;

    protected $with = ['box', 'author', 'supplier', 'supplierItem', 'playautoCategory'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'inventory' => 'integer',
            'supplier_out_of_stock_count' => 'integer',
            'safe_inventory' => 'integer',
            'category' => 'string',
            'maker' => 'string',
            'brand' => 'string',
            'cost_price' => 'integer',
            'last_cost_price' => 'integer',
            'suggested_selling_price' => 'integer',
            'suggested_retail_price' => 'integer',
            'spec' => 'string',
            'order_rule' => 'string',
            'barcode' => 'string',
            'ship_quantity' => 'integer',
            'memo' => 'string',
            'print_classification' => 'string',
            'is_supplier_out_of_stock' => 'boolean',
            'can_be_shipped' => 'boolean',
            'is_shutdown' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Item $item) {
            $item->author_id = $item->author_id ?? Auth::user()->id;
        });

        static::saved(function (Item $item) {
            if (is_null($item->sku)) {
                $item->sku = $item->id;
                $item->save();
            }
        });
    }

    public function scopeShutdown($query)
    {
        return $query->where('is_shutdown', true);
    }

    public function scopeNotShutdown($query)
    {
        return $query->where('is_shutdown', false);
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplierItem(): BelongsTo
    {
        return $this->belongsTo(SupplierItem::class);
    }

    public function playautoCategory(): BelongsTo
    {
        return $this->belongsTo(PlayautoCategory::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function purchaseOrderItems(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function inventoryHistories(): HasMany
    {
        return $this->hasMany(InventoryHistory::class);
    }

    /**
     * Update inventory.
     *
     * @param  int  $inventory  Good's inventory amount
     * @param string caller model::class name
     * @param  int  $attribute  caller's attribute
     * @return mixed On success Model::$data if its not empty or true, false on failure
     */
    public function plusminus(int $inventory, string $model, int $attribute)
    {
        $this->inventory += $inventory;

        $this->save();

        $type = $inventory > 0 ? EnumInventoryHistory::WAREHOUSING->name : EnumInventoryHistory::SHIPPING->name;

        return $this->inventoryHistories()->create([
            'item_id' => $this->id,
            'type' => $type,
            'quantity' => $inventory,
            'after_quantity' => $this->getOriginal('inventory'),
            'historyable_type' => $model,
            'historyable_id' => $attribute,
            'is_success' => true,
        ]);
    }
}
