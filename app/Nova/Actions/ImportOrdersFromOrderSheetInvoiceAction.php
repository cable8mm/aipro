<?php

namespace App\Nova\Actions;

use App\Enums\OrderSheetInvoiceStatus;
use App\Imports\OrderSheetInvoicesImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportOrdersFromOrderSheetInvoiceAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->status = OrderSheetInvoiceStatus::RUNNING->name;
            $model->save();

            try {
                $importFormat = pathinfo($model->order_sheet_file, PATHINFO_EXTENSION) == 'xlsx'
                    ? \Maatwebsite\Excel\Excel::XLSX
                    : \Maatwebsite\Excel\Excel::XLS;

                Excel::import(
                    new OrderSheetInvoicesImport($model),
                    $model->order_sheet_file,
                    'local',
                    $importFormat
                );

                $model->status = OrderSheetInvoiceStatus::SUCCESS->name;
                $model->save();
            } catch (\Exception $e) {
                $model->status = OrderSheetInvoiceStatus::ERROR->name;
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
        return __('Import Orders From Order Sheet Invoice Action');
    }
}
