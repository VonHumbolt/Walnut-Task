<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $data = $request->json()->all();
        return response()->json(["ok" => true, "title" => $data['title']]);
    }
}
