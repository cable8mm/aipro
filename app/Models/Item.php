<?php

namespace App\Models;

use App\Enums\InventoryHistory as EnumInventoryHistory;
use App\Enums\ItemStatus;
use Cable8mm\NFormat\NFormat;
use Illuminate\Database\Eloquent\Builder;
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
            'active' => 'boolean',
            'discontinued_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Item $item) {
            $item->author_id = $item->author_id ?? Auth::user()->id;
        });

        static::saving(function (Item $item) {
            /**
             * Calculate the zero margin price of the item.
             */
            $item->zero_margin_price = $item->calculateZeroMarginPrice();

            /**
             * Calculate suggested selling price for item with rounding minimum price.
             */
            $item->suggested_selling_price = $item->calculateSuggestedSellingPrice();

            /**
             * When `discontinued_at` is set to datetime, `inventory_level` will be set to `discontinued` status.
             */
            $item->status = ItemStatus::{$item->status}->status($item->inventory, $item->discontinued_at)->name;
        });

        static::saved(function (Item $item) {
            if (is_null($item->sku)) {
                $item->sku = $item->id;
                $item->save();
            }
        });
    }

    public function scopeOffSale(Builder $query)
    {
        return $query->whereNotNull('discontinued_at');
    }

    public function scopeOnSale(Builder $query)
    {
        return $query->whereNull('discontinued_at');
    }

    public function scopeLatestOne(Builder $query)
    {
        return $query->orderBy('id', 'desc')->first();
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

    /**
     * Calculates the zero margin price for the given inventory
     *
     * @return int The method returns a zero margin price
     *
     * @example Item::find(1)->calculateZeroMarginPrice() => 32243
     */
    public function calculateZeroMarginPrice(): int
    {
        $PRICE_COEFFICIENT_WITH_BOX_FEE = 1.0137;	// 1 + Monthly box total amount divide total amount without refund order
        $CARD_FEE_COEFFICIENT = 0.966;	            // 1 - card pay fee e.g 3.4%
        $SHIPPING_FEE = 2442;                       // unit shipping fee is that monthly total delivery amount divided total delivery count
        $goodMargin = 0;                            // Zero means no margin

        return $this->last_cost_price >= 25000 ?
        ((1 + $goodMargin) * $this->last_cost_price + $SHIPPING_FEE) / $CARD_FEE_COEFFICIENT * $PRICE_COEFFICIENT_WITH_BOX_FEE :
        ((1 + $goodMargin) * $this->last_cost_price + $SHIPPING_FEE * $this->last_cost_price / 25000) / $CARD_FEE_COEFFICIENT * $PRICE_COEFFICIENT_WITH_BOX_FEE;
    }

    public function calculateSuggestedSellingPrice(): int
    {
        $MARGIN_COEFFICIENT = 1. + Setting::get('ITEM_DEFAULT_MARGIN_COEFFICIENT') * 0.01;

        return NFormat::smartPrice($this->zero_margin_price * $MARGIN_COEFFICIENT);
    }
}
