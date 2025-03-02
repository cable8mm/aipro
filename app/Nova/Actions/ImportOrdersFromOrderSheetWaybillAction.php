<?php

namespace App\Nova\Actions;

use App\Enums\OrderSheetWaybillStatus;
use App\Exceptions\OptionGoodInvalidArgumentException;
use App\Imports\OrderSheetWaybillsImport;
use App\Models\Box;
use App\Models\Order;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportOrdersFromOrderSheetWaybillAction extends Action
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
            $model->status = OrderSheetWaybillStatus::RUNNING->value;
            $model->save();

            try {
                $importFormat = pathinfo($model->order_sheet_file, PATHINFO_EXTENSION) == 'xlsx'
                    ? \Maatwebsite\Excel\Excel::XLSX
                    : \Maatwebsite\Excel\Excel::XLS;

                $orderSheetWaybillsImport = new OrderSheetWaybillsImport($model);

                Excel::import(
                    $orderSheetWaybillsImport,
                    $model->order_sheet_file,
                    'local',
                    $importFormat
                );

                Order::insert(
                    $model->ordersWithSiteOrderNo()
                );

                $model->orders()->update([
                    'box_id' => Box::default()->id,
                ]);

                $model->row_count = $orderSheetWaybillsImport->getNumberOfLines();
                $model->order_count = $model->orderShipments()->distinct()->count('orderNo');
                $model->order_good_count = $model->orderShipments()->count();   // only as good master codes
                $model->status = OrderSheetWaybillStatus::SUCCESS->value;
                $model->save();
            } catch (OptionGoodInvalidArgumentException $e) {
                $e->save();

                $model->status = OrderSheetWaybillStatus::ERROR->value;
                $model->save();

                return Action::danger($e->getMessage());
            } catch (\Exception $e) {
                $model->status = OrderSheetWaybillStatus::ERROR->value;
                $model->save();

                return Action::danger($e->getMessage());
            }
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

    // /**
    //  * Register `then`, `catch` and `finally` event on batchable job.
    //  *
    //  * @return void
    //  */
    // public function withBatch(ActionFields $fields, PendingBatch $batch)
    // {
    //     //
    // }

    public function name()
    {
        return __('Import Orders From Order Sheet Waybill Action');
    }
}
