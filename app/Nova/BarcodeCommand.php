<?php

namespace App\Nova;

use App\Traits\NovaAuthorizedByManager;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BarcodeCommand extends Resource
{
    use NovaAuthorizedByManager;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BarcodeCommand>
     */
    public static $model = \App\Models\BarcodeCommand::class;

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
        'barcode',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make('ID')
                ->rules(Rule::unique('barcode_commands')->ignore($this->id), 'required')
                ->required()->sortable(),
            Text::make(__('Name'), 'name')
                ->rules(Rule::unique('barcode_commands')->ignore($this->id), 'required')
                ->required()->maxlength(100),
            Text::make(__('Barcode'), 'barcode')
                ->rules(Rule::unique('barcode_commands')->ignore($this->id), 'required')
                ->required()->maxlength(20),
            Text::make(__('Barcode Image'), function () {
                return '<img class=\'py-2\' src=\''.route('generate-barcode', ['barcode' => $this->barcode]).'\' />';
            })->asHtml(),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),
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
        return __('Barcode Commands');
    }
}
