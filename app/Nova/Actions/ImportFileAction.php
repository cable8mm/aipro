<?php

namespace App\Nova\Actions;

use App\Enums\ImportType;
use App\Enums\Status;
use App\Imports\GoodsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportFileAction extends Action
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
            try {
                switch ($model->type) {
                    case ImportType::GOOD->name:
                        Excel::import(new GoodsImport, $model->attachment, 'public');
                        break;
                    case ImportType::ORDER_SHEET_INVOICE->name:
                        Excel::import(new ImportOrdersFromOrderSheetInvoiceAction, $model->attachment, 'public');
                        break;
                    default:
                        throw new \Exception(__('Invalid import type.'));
                }

                $model->status = Status::SUCCESS->name;
                $model->save();
            } catch (\Exception $e) {
                $model->status = Status::FAILED->name;
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

    public function name()
    {
        return __('Importing Goods');
    }
}
