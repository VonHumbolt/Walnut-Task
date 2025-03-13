<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomingLogController extends Controller
{
    public function show() {
        return view('incomingLogs');
    }
}
