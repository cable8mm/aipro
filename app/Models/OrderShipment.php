<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderShipment extends Model
{
    use HasFactory;

    protected $with = ['orderSheetInvoice'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'order_sheet_invoice_id' => 'integer',
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
            'invoiceCompany' => 'string',
            'invoiceNo' => 'string',
            'invoiceFilePath' => 'string',
            'invoiceFilePage' => 'integer',
            'invoiceGoodsCd' => 'string',
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

    public function orderSheetInvoice(): BelongsTo
    {
        return $this->belongsTo(OrderSheetInvoice::class);
    }

    public function good(): HasOne
    {
        return $this->hasOne(Good::class, 'masterGoodsCd', 'master_code');
    }
}
