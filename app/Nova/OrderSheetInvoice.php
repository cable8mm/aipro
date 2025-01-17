<?php

namespace App\Nova;

use App\Enums\Status;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderSheetInvoice extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OrderSheetInvoice>
     */
    public static $model = \App\Models\OrderSheetInvoice::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Hidden::make('Author', 'author')->default(function ($request) {
                return $request->user()->id;
            }),
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            Text::make(__('Title'), 'title', function () {
                return $this->title();
            }),
            File::make(__('Excel Filepath'), 'excel_filepath'),
            Number::make(__('Order Row Count'), 'order_row_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms(),
            Number::make(__('Order Number Count'), 'order_number_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms(),
            Number::make(__('Order Good Count'), 'order_good_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms(),
            File::make(__('Invoice Filepath'), 'invoice_filepath'),
            Select::make(__('Status'), 'status')
                ->options(Status::array())->displayUsingLabels()->filterable(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ]),

            HasMany::make(__('Order Shipments'), 'orderShipments', OrderShipment::class),

            HasMany::make(__('Orders'), 'orders', Order::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function label()
    {
        return __('Order Sheet Invoice');
    }

    public function title()
    {
        return __('Order Sheet Invoice').' '.'#'.$this->id;
    }
}
