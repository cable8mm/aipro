<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderShipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'order_sheet_waybill_id' => 'integer',
            'orderNo' => 'string',
            'site' => 'string',
            'registDate' => 'string',
            'orderDate' => 'string',
            'paymentDate' => 'string',
            'statusDate' => 'string',
            'deliveryDate' => 'string',
            'status' => 'string',
            'siteOrderNo' => 'string',
            'siteGoodsCd' => 'string',
            'goodsNm' => 'string',
            'option' => 'string',
            'optionPrice' => 'integer',
            'additionalOption' => 'string',
            'additionalOptionPrice' => 'integer',
            'costPrice' => 'integer',
            'fixedPrice' => 'integer',
            'totalPrice' => 'integer',
            'amount' => 'integer',
            'totalAmount' => 'integer',
            'confirmAmount' => 'integer',
            'deliveryType' => 'string',
            'deliveryPrice' => 'integer',
            'totalDeliveryPrice' => 'integer',
            'orderName' => 'string',
            'orderPhone' => 'string',
            'orderCellPhone' => 'string',
            'receiverName' => 'string',
            'receiverPhone' => 'string',
            'receiverCellPhone' => 'string',
            'postcode' => 'string',
            'address' => 'string',
            'waybillCompany' => 'string',
            'waybillNo' => 'string',
            'waybillFilePath' => 'string',
            'waybillFilePage' => 'integer',
            'waybillGoodsCd' => 'string',
            'payGoodsCd' => 'string',
            'masterGoodsCd' => 'string',
            'validator' => 'integer',
            'isSet' => 'string',
            'printed' => 'string',
            'downloaded' => 'string',
            'shipped' => 'string',
            'boxes' => 'string',
            'shippable' => 'string',
            'inventory' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'printed_at' => 'datetime',
            'downloaded_at' => 'datetime',
            'shipped_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function orderSheetWaybill(): BelongsTo
    {
        return $this->belongsTo(OrderSheetWaybill::class);
    }

    public function orderShipments(): HasMany
    {
        return $this->hasMany(OrderShipment::class, 'orderNo', 'orderNo');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'masterGoodsCd', 'master_code');
    }

    public function setGoods(): HasMany
    {
        return $this->hasMany(SetGood::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderNo', 'id');
    }
}
