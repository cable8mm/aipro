<?php

namespace App\Nova\Repeaters;

use App\Models\Item as ModelsItem;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class RetailPurchaseItem extends Repeatable
{
    /**
     * The underlying model the repeatable represents.
     *
     * @var class-string<\App\Models\RetailPurchaseItem>
     */
    public static $model = \App\Models\RetailPurchaseItem::class;

    /**
     * Get the fields displayed by the repeatable.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make(),

            Select::make(__('Item'), 'item_id')
                ->rules('required')->required()
                ->searchable()
                ->options(fn () => ModelsItem::select(
                    DB::raw("CONCAT('[', sku, '] ', name, ' - ', suggested_selling_price, '(', units_per_case, ')') AS complex_name"),
                    'id'
                )->pluck('complex_name', 'id'))
                ->help('['.__('SKU').'] '.__('Name').'-'.__('Suggested Selling Price').'('.__('Units Per Case').')'),

            Number::make(__('Quantity'), 'quantity')
                ->rules(['required', 'gt:0'])->required()
                ->default(1),

            Currency::make(__('Unit Price'), 'unit_price')
                ->rules('required')->required(),

            Currency::make(__('Subtotal'), 'subtotal')
                ->rules('required')->required(),
        ];
    }
}
