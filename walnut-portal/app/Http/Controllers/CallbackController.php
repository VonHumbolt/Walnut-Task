<?php

namespace App\Http\Controllers;

use App\Models\CallbackLog;
use App\Models\IncomingLog;
use App\Models\IncomingLogData;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CallbackController extends Controller
{
    public function callback(Request $request)
    {
        try {
            $newsData = $this->sendRequestToNewsApi();

            if (!is_array($newsData)) {
                return response()->json(['error' => 'Content must be an array!'], 400);
            }

            $incomingLogData = IncomingLogData::create(['payload' => json_encode($newsData)]);
            $insertedDataArray = [];

            foreach ($newsData as $data) {
                $isIncomingLogExists = IncomingLog::where('title', '=', $data['title'])->where('word_count', '=', $data['word_count'])->first();

                if ($isIncomingLogExists) {
                    $insertedDataArray[] = [
                        "source" => "https://www.bbc.com/turkce",
                        "title" => $data["title"],
                        "word_count" => $data["word_count"],
                        "incoming_log_data_id" => $incomingLogData->id
                    ];
                } else {
                    $incomingLog = IncomingLog::create([
                        "source" => "https://www.bbc.com/turkce",
                        "title" => $data["title"],
                        "word_count" => $data["word_count"],
                        "incoming_log_data_id" => $incomingLogData->id
                    ]);

                    // send request to /test-receiver endpoint
                    $response = $this->sendRequestToTestReceiver($data);
                    $returnTestResult = $response->json();

                    if ($returnTestResult["success"] == true) {
                        CallbackLog::create([
                            "result" => $returnTestResult['data'],
                            "status" => "confirmed",
                            "incoming_log_id" => $incomingLog->id
                        ]);
                    }
                }
            }

            if (count($insertedDataArray) > 0) {
                IncomingLogData::update(["inserted" => $insertedDataArray]);
            }
            return response()->json(["success" => true, "message" => "Successfully saved"]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unexpected error occured!', 'errorMessage' => $e->getMessage()], 400);
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


    private function sendRequestToTestReceiver(array $data)
    {
        $response = Http::timeout(10)->post(
            route('test'),
            $data
        );
        if ($response->successful()) {
            return response()->json(["success" => true, "data" => $response->json()]);
        } else {
            return response()->json(["success" => false]);
        }
      
    }

}
