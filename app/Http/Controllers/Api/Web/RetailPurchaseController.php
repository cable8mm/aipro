<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\RetailPurchase;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class RetailPurchaseController extends Controller
{
    /**
     * /api/web/retail-purchase/{id}/print
     *
     * Print the retail purchase.
     */
    public function print(RetailPurchase $retailPurchase)
    {
        $pdf = LaravelMpdf::loadView('pdf.retail-purchase', [
            'retailPurchase' => $retailPurchase,
        ]);

        return $pdf->stream('document.pdf');
    }
}
