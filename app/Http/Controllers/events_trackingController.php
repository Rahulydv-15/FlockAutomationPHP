<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\events_tracking;
use Illuminate\Support\Facades\Http;

class events_trackingController extends Controller
{
    public function sendMessage()
    {
        $data = events_tracking::first();

        $jsonData = json_encode($data);
        print_r($jsonData);

        $payload = "<flockml>Hello! Data is <br><br>" .
                   "<br><br>" .
                   "$jsonData " .
                   "<b>Status: SUCCESS</b></flockml>";

        $payloadData = json_encode(['flockml' => $payload]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flock.com/hooks/sendMessage/909c6b59-000e-43c8-bc2a-2c73c5b002cc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payloadData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        die;
    }
}
