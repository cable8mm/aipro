<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderSheetInvoice;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class PrintController extends Controller
{
    /**
     * Print Order Sheet Invoice
     *
     * @param  \App\Models\OrderSheetInvoice  $orderSheetInvoice  The Order Sheet Invoice instance to print
     * @return \Illuminate\Http\Response The method returns the response object with printing
     */
    public function orderSheetInvoice(OrderSheetInvoice $orderSheetInvoice)
    {
        $layout = '
        <htmlpageheader name="myHTMLHeaderOdd" style="display:none">
        <div style="background-color:#FFFFFF" align="center"><b>&nbsp;{PAGENO}&nbsp;</b></div>
        </htmlpageheader>
        <htmlpagefooter name="myHTMLFooterOdd" style="display:none">
        <div style="background-color:#FFFFFF" align="center"><b>&nbsp;{PAGENO}&nbsp;</b></div>
        </htmlpagefooter>
        <sethtmlpageheader name="myHTMLHeaderOdd" page="O" value="on" show-this-page="1" />
        <sethtmlpagefooter name="myHTMLFooterOdd" page="O" value="on" show-this-page="1" />
        ';

        $pdf = LaravelMpdf::loadHTML($layout);

        foreach ($orderSheetInvoice->orders as $order) {

            if (! isset($order->latestOrderShipment)) {
                continue;
            }

            $html = view('pdf.order_invoice', [
                'order' => $order,
            ]);

            $pdf->getMpdf()->WriteHTML($html);

            if ($order !== $orderSheetInvoice->orders->last()) {
                $pdf->getMpdf()->WriteHTML('<pagebreak />');
            }
        }

        return $pdf->stream('document.pdf');
    }

    public function order(Order $order)
    {
        $pdf = LaravelMpdf::loadView('pdf.order_invoice', [
            'order' => $order,
        ]);

        return $pdf->stream('document.pdf');
    }
}
