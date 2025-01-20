<?php

namespace App\Http\Controllers;

use App\Models\BarcodeCommand;
use App\Models\Box;
use Illuminate\Http\Request;

class BarcodeCommandController extends Controller
{
    public function __invoke(Request $request)
    {
        $barcodeCommands = BarcodeCommand::get();

        $boxes = Box::get();

        return view('barcode_command.show', [
            'barcodeCommands' => $barcodeCommands,
            'boxes' => $boxes,
        ]);
    }
}
