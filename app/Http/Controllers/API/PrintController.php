<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderSheetInvoice;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use OutOfRangeException;

class PrintController extends Controller
{
    /**
     * /print/order-sheet-invoice/{id}
     *
     * Print the order sheet invoice
     *
     * @param  \App\Models\OrderSheetInvoice  $orderSheetInvoice  The Order Sheet Invoice instance to print
     * @return \Illuminate\Http\Response The method returns the response object with printing
     */
    public function orderSheetInvoice(OrderSheetInvoice $orderSheetInvoice): \Illuminate\Http\Response
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
                throw new OutOfRangeException(__('Order #:order_id must have a order shipment.', ['order_id' => $order->id]));
            }

            $pdf->getMpdf()->WriteHTML(
                view('pdf.order_invoice', [
                    'order' => $order,
                ])
            );

            if ($order !== $orderSheetInvoice->orders->last()) {
                $pdf->getMpdf()->WriteHTML('<pagebreak />');
            }
        }

        return $pdf->stream('document.pdf');
    }

    /**
     * /print/order/{id}
     *
     * Print the order
     */
    public function order(Order $order): \Symfony\Component\HttpFoundation\Response
    {
        $pdf = LaravelMpdf::loadView('pdf.order_invoice', [
            'order' => $order,
        ]);

        return $pdf->stream('document.pdf');
    }
}
