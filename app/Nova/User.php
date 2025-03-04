<?php

namespace App\Nova;

use App\Enums\Locale;
use App\Enums\UserType;
use App\Traits\NovaAuthorizedByManager;
use Cable8mm\ValidationKisaRules\Rules\KisaPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Timezone;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class User extends Resource
{
    use NovaAuthorizedByManager;

    public static $globallySearchable = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

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
        'name',
        'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field|\Laravel\Nova\Panel|\Laravel\Nova\ResourceTool|\Illuminate\Http\Resources\MergeValue>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Gravatar::make(__('Avatar'))->maxWidth(50),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Email::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Select::make(__('Type'), 'type')->required()->options(UserType::array())->displayUsingLabels(),

            Timezone::make(__('Timezone'), 'timezone')->required()->searchable()
                ->default(Auth::user()?->timezone)
                ->help(__('If you are in Korea, select "Asia/Seoul".')),

            // Select::make(__('Locale'), 'locale')->rules('required')->required()
            //     ->options(Locale::array())
            //     ->default(Auth::user()?->language)
            //     ->displayUsingLabels()
            //     ->help(__('If you are in Korea, select "ko".')),

            Panel::make(__('Change Password'), [
                Password::make(__('Password'), 'password')
                    ->onlyOnForms()
                    ->creationRules('required', new KisaPassword, 'confirmed')
                    ->updateRules('nullable', new KisaPassword, 'confirmed'),

                PasswordConfirmation::make(__('Password Confirmation'), 'password_confirmation'),
            ])->limit(1),

            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }

    public static function label(): string
    {
        return __('User');
    }

    public function authorizedToView(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR
            || $request->user()?->type == UserType::DEVELOPER
            || $request->user()?->type == UserType::MANAGER
            || $request->user()?->id == $this->id;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR
            || $request->user()?->type == UserType::DEVELOPER
            || $request->user()?->type == UserType::MANAGER
            || $request->user()?->id == $this->id;
    }
}
