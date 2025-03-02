<?php

namespace App\Nova;

use App\Enums\OrderSheetWaybillStatus;
use App\Nova\Actions\ChangeStatusAction;
use App\Nova\Actions\ImportOrdersFromOrderSheetWaybillAction;
use App\Nova\Actions\OrderShipmentWaybillResetAction;
use App\Nova\Actions\PrintOrderSheetWaybill;
use App\Traits\NovaAuthorizedByWarehouser;
use Illuminate\Support\Number as SupportNumber;
use Illuminate\Validation\Rules\File as RulesFile;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status as FieldsStatus;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderSheetWaybill extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OrderSheetWaybill>
     */
    public static $model = \App\Models\OrderSheetWaybill::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
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
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            Text::make(__('Title'), 'title', function () {
                return $this->title();
            })->exceptOnForms(),

            Number::make(__('Row Count'), 'row_count')->nullable()->displayUsing(function ($value) {
                return ! is_null($value) ? number_format($value) : null;
            })->exceptOnForms(),
            Number::make(__('Order Count'), 'order_count')->nullable()->exceptOnForms(),
            Number::make(__('Order Good Count'), 'order_good_count')->nullable()->displayUsing(function ($value) {
                return ! is_null($value) ? number_format($value) : null;
            })->exceptOnForms(),

            File::make(__('Order Sheet File'), 'order_sheet_file')->required()
                ->creationRules([
                    'required',
                    RulesFile::types(['xlsx', 'xls', 'csv'])->max(48 * 1024),
                ])
                ->updateRules([
                    'nullable',
                    RulesFile::types(['xlsx', 'xls', 'csv'])->max(48 * 1024),
                ])
                ->help(__('Upload an Excel file (xlsx, xls, csv)'))
                ->disk('local')
                ->path('waybills')
                ->storeOriginalName('order_sheet_file_name')
                ->storeSize('order_sheet_file_size')
                ->prunable(),

            File::make(__('Waybill File'), 'waybill_file')
                ->creationRules([
                    RulesFile::types(['pdf'])->max(48 * 1024),
                ])
                ->updateRules([
                    RulesFile::types(['pdf'])->max(48 * 1024),
                ])
                ->help(__('Upload Waybill file (pdf)'))
                ->disk('local')
                ->path('waybills')
                ->disk('test')
                ->path('uploads/waybills')
                ->storeOriginalName('waybill_file_name')
                ->storeSize('waybill_file_size')
                ->prunable(),

            Stack::make(__('Order Sheet File').' & '.__('Waybill File Name'), [
                Text::make(__('Order Sheet File Name'), 'order_sheet_file_name')
                    ->exceptOnForms(),

                Text::make(__('Waybill File Name'), 'waybill_file_name')
                    ->exceptOnForms(),
            ]),

            Stack::make(__('File Sizes'), [
                Number::make(__('Order Sheet File Size'), 'order_sheet_file_size')
                    ->exceptOnForms()
                    ->displayUsing(function ($value) {
                        return $value ? SupportNumber::fileSize($value, precision: 2) : '-';
                    }),

                Number::make(__('Waybill File Size'), 'waybill_file_size')
                    ->exceptOnForms()
                    ->displayUsing(function ($value) {
                        return $value ? SupportNumber::fileSize($value, precision: 2) : '-';
                    }),
            ]),

            FieldsStatus::make(__('Status'), 'status')
                ->default(OrderSheetWaybillStatus::FILE_UPLOADED)
                ->loadingWhen(OrderSheetWaybillStatus::loadingWhen())
                ->failedWhen(OrderSheetWaybillStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return OrderSheetWaybillStatus::from($value)?->value() ?? '-';
                }),
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
        return [
            (new ImportOrdersFromOrderSheetWaybillAction)->showInline(),
            (new ChangeStatusAction(OrderSheetWaybillStatus::CANCEL))->showInline(),
            (new OrderShipmentWaybillResetAction)->showInline(),
            (new PrintOrderSheetWaybill)->showInline(),
        ];
    }

    public static function label()
    {
        return __('Order Sheet Waybill');
    }

    public function title()
    {
        return __('Order Sheet Waybill').' '.'#'.$this->id;
    }
}
