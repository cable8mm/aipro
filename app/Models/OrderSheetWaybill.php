<?php

namespace App\Models;

use App\Enums\OrderSheetWaybillStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderSheetWaybill extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'row_count' => 'integer',
            'order_count' => 'integer',
            'order_good_count' => 'integer',
            'order_sheet_file' => 'string',
            'order_sheet_file_name' => 'string',
            'order_sheet_file_size' => 'integer',
            'waybill_file' => 'string',
            'waybill_file_name' => 'string',
            'waybill_file_size' => 'integer',
            'excel_json' => 'json',
            'status' => OrderSheetWaybillStatus::class,
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (OrderSheetWaybill $orderSheetWaybill) {
            $orderSheetWaybill->author_id = $orderSheetWaybill->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function latestOrder(): HasOne
    {
        return $this->hasOne(Order::class)->latestOfMany();
    }

    public function orderShipments(): HasMany
    {
        return $this->hasMany(OrderShipment::class);
    }

    public function mismatchedOrderShipments(): HasMany
    {
        return $this->hasMany(MismatchedOrderShipment::class);
    }

    public function items(): HasManyThrough
    {
        return $this->hasManyThrough(
            Item::class,
            OrderShipment::class,
            'order_sheet_waybill_id',
            'sku',
            'id',
            'goodsCd'
        );
    }

    /**
     * Get the orders with siteOrderNo and order_good_count
     *
     * The return values can save them to `Order` model
     *
     * @return array<int,string> The method returns a collection with siteOrderNo and order_good_count
     *
     * @example $orderSheetWaybill->ordersWithSiteOrderNo() => [["id"=>193572321, "order_good_count"=>3], ["id"=>202010058612779, "order_good_count"=>1], ...]
     */
    public function ordersWithSiteOrderNo(): array
    {
        return $this->orderShipments()
            ->select(
                DB::raw('orderNo as id'),
                DB::raw('count(*) as order_good_count'),
                DB::raw('GROUP_CONCAT(DISTINCT `waybillNo`) as waybill_numbers'),
                'order_sheet_waybill_id'
            )
            ->groupBy('orderNo', 'order_sheet_waybill_id')
            ->get()
            ->select(['id', 'order_good_count', 'waybill_numbers', 'order_sheet_waybill_id'])
            ->toArray();
    }
}
