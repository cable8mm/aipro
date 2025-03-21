<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\BarcodeCommand;
use App\Models\Box;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class BarcodeCommandController extends Controller
{
    /**
     * /api/web/barcode-command/print
     *
     * Print the order
     */
    public function print(Request $request)
    {
        $barcodeCommands = BarcodeCommand::get();

        $boxes = Box::get();

        $pdf = LaravelMpdf::loadView('pdf.barcode_command', [
            'barcodeCommands' => $barcodeCommands,
            'boxes' => $boxes,
        ]);

        return $pdf->stream('document.pdf');
    }
}
