<?php

namespace App\Http\Controllers;

use App\Models\Box;

class MonitorController extends Controller
{
    public function __invoke()
    {
        return view('monitor', [
            'boxes' => Box::pluck('name', 'id'),
        ]);
    }
}
