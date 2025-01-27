<?php

namespace App\Nova;

use App\Enums\ImportType;
use App\Enums\Status as EnumsStatus;
use App\Nova\Actions\ImportFileAction;
use App\Traits\NovaAuthorizedByManager;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class RegisterImportFile extends Resource
{
    use NovaAuthorizedByManager;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RegisterImportFile>
     */
    public static $model = \App\Models\RegisterImportFile::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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

            Select::make(__('Type'), 'type')->options(ImportType::array())
                ->rules('required')
                ->displayUsingLabels()
                ->filterable(),

            Text::make(__('Memo'), 'memo')
                ->rules('required', 'max:191')
                ->help('파일에 대한 설명을 간략히 작성합니다.'),

            File::make(__('Attachment'), 'attachment')
                ->creationRules('required', 'file', 'mimes:xlsx,xls,csv')
                ->updateRules('nullable', 'file', 'mimes:xlsx,xls,csv')
                ->help('엑셀 파일을 업로드합니다. (xlsx, xls, csv)')
                ->disk('public')
                ->path('uploads/register_import_files')
                ->storeOriginalName('attachment_name')
                ->storeSize('attachment_size')
                ->prunable(),

            Text::make(__('Attachment Name'), 'attachment_name')
                ->exceptOnForms(),

            Text::make(__('Attachment Size'), 'attachment_size')
                ->exceptOnForms()
                ->displayUsing(function ($value) {
                    return $value ? number_format($value / 1024, 2).'kb' : '-';
                }),

            Status::make(__('Status'), 'status')
                ->loadingWhen(EnumsStatus::loadingWhen())
                ->failedWhen(EnumsStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return EnumsStatus::{$value}->value() ?? '-';
                }),

            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnIndex(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnIndex(),
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
            (new ImportFileAction)->showInline(),
        ];
    }

    public static function label()
    {
        return __('Register Import Files');
    }
}
