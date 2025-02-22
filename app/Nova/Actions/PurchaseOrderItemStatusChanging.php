<?php

namespace App\Nova\Actions;

use App\Enums\PurchaseOrderItemStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class PurchaseOrderItemStatusChanging extends DestructiveAction
{
    use InteractsWithQueue, Queueable;

    public function __construct(
        private PurchaseOrderItemStatus $status
    ) {}

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        try {
            /**
             * @var \App\Models\PurchaseOrderItem $model
             */
            foreach ($models as $model) {
                if (PurchaseOrderItemStatus::cannot($model->status, $this->status)) {
                    throw new \RuntimeException(__('The status cannot be changed.'));
                }

                $model->status = $this->status->name;

                $model->save();
            }
        } catch (\Exception $e) {
            return Action::danger($e->getMessage());
        }

        return $models;
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
        return __('Treat as :status', ['status' => $this->status->value()]);
    }
}
