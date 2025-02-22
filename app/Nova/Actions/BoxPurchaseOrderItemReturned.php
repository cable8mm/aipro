<?php

namespace App\Nova\Actions;

use App\Enums\PurchaseOrderItemStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxPurchaseOrderItemReturned extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if ($models->count() !== 1) {
            return Action::danger(__('One item must be selected.'));
        }

        try {
            /**
             * @var \App\Models\BoxPurchaseOrderItem $model
             */
            foreach ($models as $model) {
                if (PurchaseOrderItemStatus::can($model->status, PurchaseOrderItemStatus::RETURNED)) {
                    $boxPurchaseOrderItem = $model->returned($fields->quantity);

                    return ActionResponse::visit('/resources/box-purchase-order-items/'.$boxPurchaseOrderItem->id);
                } else {
                    throw new \RuntimeException(__('The status cannot be changed.'));
                }
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
        return [
            Number::make(__('Quantity'), 'quantity')
                ->rules('required')->required()
                ->default(-1)
                ->help(__('If it sets the minus value, the status is going to set RETURNED automatically.')),
        ];
    }

    public function name()
    {
        return __('Returning');
    }
}
