<?php

namespace App\Nova\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class ChangeStatusAction extends DestructiveAction
{
    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->status = $this->status->value;
            $model->save();

            $model->author->notify(
                NovaNotification::make()
                    ->message(__('Your request for regist of Option Good is completed.'))
                    ->action(__('Visit'), new URL('resources/'.Str::slug($model->getTable(), '-').'/'.$model->id))
                    ->icon('check-circle')
                    ->type('success')
            );
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }

    public function name()
    {
        return __('Change Status Action - :status', ['status' => $this->status->value()]);
    }
}
