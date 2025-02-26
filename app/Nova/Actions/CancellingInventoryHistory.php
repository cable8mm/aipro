<?php

namespace App\Nova\Actions;

use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use RuntimeException;

class CancellingInventoryHistory extends DestructiveAction
{
    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        /**
         * @var \App\Models\InventoryHistory|\App\Models\BoxInventoryHistory $model
         */
        foreach ($models as $model) {
            try {
                $model->cancelling();
            } catch (RuntimeException $e) {
                return Action::danger($e->getMessage());
            } catch (\Exception $e) {
                return Action::danger($e->getMessage());
            }
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
        return __('Cancelling Inventory History');
    }
}
