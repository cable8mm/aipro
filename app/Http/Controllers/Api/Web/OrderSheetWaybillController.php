<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\OrderSheetWaybill;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use OutOfRangeException;

class OrderSheetWaybillController extends Controller
{
    /**
     * /api/web/order-sheet-waybill/{id}/print
     *
     * Print the order sheet waybill
     *
     * @param  \App\Models\OrderSheetWaybill  $orderSheetWaybill  The Order Sheet waybill instance to print
     * @return \Illuminate\Http\Response The method returns the response object with printing
     */
    public function print(OrderSheetWaybill $orderSheetWaybill)
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

        foreach ($orderSheetWaybill->orders as $order) {
            if (! isset($order->latestOrderShipment)) {
                throw new OutOfRangeException(__('Order #:order_id must have a order shipment.', ['order_id' => $order->id]));
            }

            $pdf->getMpdf()->WriteHTML(
                view('pdf.order_waybill', [
                    'order' => $order,
                ])
            );

            if ($order !== $orderSheetWaybill->orders->last()) {
                $pdf->getMpdf()->WriteHTML('<pagebreak />');
            }
        }

        $orderSheetWaybill->printed();

        return $pdf->stream('document.pdf');
    }
}
