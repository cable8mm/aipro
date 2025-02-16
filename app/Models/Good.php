<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class Good extends Model
{
    use Actionable, HasFactory;

    protected $with = ['box', 'author', 'supplier', 'supplierGood', 'playautoCategory'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'list_image' => 'string',
            'godo_code' => 'integer',
            'retail_code' => 'string',
            'playauto_master_code' => 'string',
            'center_code' => 'string',
            'playauto_category_id' => 'integer',
            'name' => 'string',
            'godo_name' => 'string',
            'option' => 'string',
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
            'supplier_monitoring_price' => 'integer',
            'supplier_monitoring_status' => 'string',
            'supplier_monitoring_interruption' => 'boolean',
            'goods_price' => 'integer',
            'goods_price_wemake2' => 'integer',
            'goods_price_holapetshop' => 'integer',
            'supplier_name' => 'string',
            'supplier_request_price' => 'integer',
            'supplier_good_code' => 'string',
            'spec' => 'string',
            'order_rule' => 'string',
            'barcode_type' => 'string',
            'barcode' => 'string',
            'picking_zone_number' => 'string',
            'storage_box_zone' => 'string',
            'goods_division_color' => 'string',
            'ship_quantity' => 'integer',
            'memo_for_center' => 'string',
            'good_classification' => 'string',
            'print_classification' => 'string',
            'naver_productid' => 'string',
            'not_exist_naver_productid' => 'boolean',
            'naver_lowest_price_wrong' => 'boolean',
            'naver_lowest_price' => 'integer',
            'internet_lowest_price' => 'integer',
            'zero_margin_price' => 'integer',
            'is_hi300' => 'boolean',
            'is_supplier_out_of_stock' => 'boolean',
            'is_my_shop_sale' => 'boolean',
            'is_other_shop_sale' => 'boolean',
            'is_not_playauto_used' => 'boolean',
            'is_playauto_done' => 'boolean',
            'is_requested_shutdown' => 'boolean',
            'is_requested_reborn' => 'boolean',
            'is_shutdown' => 'boolean',
            'is_scm_manager_confirmed' => 'boolean',
            'last_warehoused' => 'datetime',
            'supplier_out_of_stock_on_datetime' => 'datetime',
            'supplier_out_of_stock_off_datetime' => 'datetime',
            'can_be_shipped' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Good $good) {
            $good->author_id = $good->author_id ?? Auth::user()->id;
        });

        static::saved(function (Good $good) {
            if (is_null($good->master_code)) {
                $good->master_code = $good->id;
                $good->save();
            }
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

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplierGood(): BelongsTo
    {
        return $this->belongsTo(SupplierGood::class);
    }

    public function playautoCategory(): BelongsTo
    {
        return $this->belongsTo(PlayautoCategory::class);
    }

    /**
     * Get the good's promotion code.
     *
     * @see https://laravel.com/docs/11.x/eloquent-relationships#one-to-one-polymorphic-model-structure
     */
    public function promotionCode(): MorphOne
    {
        return $this->morphOne(PromotionCode::class, 'promotionCodable');
    }

    /**
     * Get the option good option's master code.
     *
     * @see https://laravel.com/docs/11.x/eloquent-relationships#one-to-one-polymorphic-model-structure
     */
    public function optionGoodOption(): MorphOne
    {
        return $this->morphOne(OptionGoodOption::class, 'optionGoodOptionable');
    }

    public function placingOrderGoods(): HasMany
    {
        return $this->hasMany(PlacingOrderGood::class);
    }

    public function scopeShutdown($query)
    {
        return $query->where('is_shutdown', true);
    }

    public function scopeNotShutdown($query)
    {
        return $query->where('is_shutdown', false);
    }

    public function inventory(int $amount): bool
    {
        return $this->update(['inventory' => $this->inventory + $amount]);
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

        $type = $inventory > 0 ? __('Receiving') : __('Shipping');

        return $this->inventoryHistories()->create([
            'good_id' => $this->id,
            'type' => $type,
            'quantity' => $inventory,
            'model' => $model,
            'attribute' => $attribute,
            'is_success' => true,
        ]);
    }
}
