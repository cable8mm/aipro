<?php

namespace App\Nova;

use App\Enums\Channel as EnumsChannel;
use App\Traits\NovaAuthorizedByManager;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Channel extends Resource
{
    use NovaAuthorizedByManager;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Channel>
     */
    public static $model = \App\Models\Channel::class;

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
            BelongsTo::make(__('Author'), 'author', User::class),
            Text::make(__('Name'), 'name')->maxlength(255),
            Text::make(__('Playauto Site'), 'playauto_site')->maxlength(190),
            Text::make(__('Siteid'), 'siteid')->maxlength(100),
            Number::make(__('Fee Rate'), 'fee_rate')->step('any'),
            Number::make(__('Total Good Count'), 'total_good_count'),
            Number::make(__('Total Sale Good Count'), 'total_sale_good_count'),
            Number::make(__('Total Sold Out Good Count'), 'total_sold_out_good_count'),
            Number::make(__('Total No Sale Good Count'), 'total_no_sale_good_count'),
            File::make(__('Filepath'), 'filepath'),
            DateTime::make(__('Last Processed At'), 'last_processed_at'),
            Textarea::make(__('Memo'), 'memo'),
            Boolean::make(__('Is Active'), 'is_active'),
            Select::make(__('Status'), 'status')->options(EnumsChannel::array())->displayUsingLabels(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ]),
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
        return __('Channels');
    }
}
