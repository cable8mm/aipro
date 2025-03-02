<?php

namespace App\Nova\Actions;

use App\Enums\PurchaseOrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class PurchaseOrderStatusChanging extends Action
{
    use InteractsWithQueue, Queueable;

    public function __construct(
        private PurchaseOrderStatus $status
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
             * @var \App\Models\PurchaseOrder|\App\Models\BoxPurchaseOrder $model
             */
            foreach ($models as $model) {
                if (PurchaseOrderStatus::cannot($model->status, $this->status)) {
                    throw new \RuntimeException(__('The status cannot be changed.'));
                }

                $model->status = $this->status;

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
