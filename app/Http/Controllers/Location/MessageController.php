<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        if (trim($request->message) != "") {
            // Send Message
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $client = new Client($sid, $token);

            $client->messages->create(
                '+14063660232',
                array(
                    'from' => env('TWILIO_FROM'),
                    'body' => $request->message
                )
            );
        }
    }
}
