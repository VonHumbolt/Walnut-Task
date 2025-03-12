<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callback(Request $request)
    {
        try {
            $data = $this->sendRequestToNewsApi();

            if (!is_array($data)) {
                return response()->json(['error' => 'Content must be an array!'], 400);
            }


        } catch (\Exception $e) {
            return response()->json(['error' => 'Unexpected error occured!'], 400);
        }
    }

    private function sendRequestToNewsApi()
    {
        ini_set('max_execution_time', 300);

        $client = new Client([
            'timeout' => 300,
        ]);
        $response = $client->request('GET', "http://localhost:3000/api/news?url=https://www.bbc.com/turkce");
        return json_decode($response->getBody(), true);
    }
  
}
