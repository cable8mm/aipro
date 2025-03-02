<?php

namespace App\Nova\Actions;

use App\Enums\OrderSheetWaybillStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderShipmentWaybillResetAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        /**
         * @var \App\Models\OrderSheetWaybill $model
         */
        foreach ($models as $model) {
            $model->mismatchedOrderShipments()->delete();
            $model->orders()->delete();
            $model->OrderShipments()->delete();

            $model->update([
                'status' => OrderSheetWaybillStatus::FILE_UPLOADED->value,
                'row_count' => null,
                'order_count' => null,
                'order_good_count' => null,
            ]);
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
        return __('Upload File Again');
    }
}
