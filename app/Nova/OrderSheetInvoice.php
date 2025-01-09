<?php

namespace App\Nova;

use App\Enums\Status as EnumsStatus;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
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
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
            BelongsTo::make(__('User'), 'user', User::class),
            Text::make(__('Name'), 'name')->maxlength(255),
            Text::make(__('Excel Filepath'), 'excel_filepath')->maxlength(255),
            Number::make(__('Order Row Count'), 'order_row_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make(__('Order Number Count'), 'order_number_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make(__('Order Good Count'), 'order_good_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Text::make(__('Invoice Filepath'), 'invoice_filepath')->maxlength(255),
            KeyValue::make(__('Excel Json'), 'excel_json'),
            Status::make(__('Status'), 'status')
                ->loadingWhen(EnumsStatus::loadingWhen())
                ->failedWhen(EnumsStatus::failedWhen()),
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
}
