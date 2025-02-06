<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderSheetInvoice;
use App\Models\OrderShipment;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class PrintController extends Controller
{
    /**
     * Print Order Sheet Invoice
     *
     * @param  string  $orderSheetInvoice  The Order Sheet Invoice instance to print
     * @return \Illuminate\Http\Response The method returns the response object with printing
     */
    public function orderSheetInvoice(OrderSheetInvoice $orderSheetInvoice)
    {
        $pdf = LaravelMpdf::loadView('pdf.invoice', [
            'orderSheetInvoice' => $orderSheetInvoice,
        ]);

        return $pdf->stream('document.pdf');
    }

    public function orderShipment(OrderShipment $orderShipment)
    {
        $orderShipments = $orderShipment->orderShipments()->get();

        $pdf = LaravelMpdf::loadView('pdf.invoice', [
            'orderShipment' => $orderShipment,
            'orderShipments' => $orderShipments,
        ]);

        return $pdf->stream('document.pdf');
    }
}
