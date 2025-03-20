<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ToggleIsActive extends Action
{
    use InteractsWithQueue;
    use Queueable;

    /**
     * Create a new instance of the action.
     *
     * @return void
     */
    public function __construct(
        // Optional: Provide a default value for the 'is_active' field
        private ?bool $isActive = null
    ) {}

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->is_active = is_null($this->isActive) ? ! $model->is_active : $this->isActive;

            $model->save();
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [];
    }

    public function name()
    {
        return match ($this->isActive) {
            true => __('Set To Be Active'),
            false => __('Set To Be Not Active'),
            default => __('Toggle Is Active'),
        };
    }
}
