<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use App\Models\User;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        if (trim($request->message) != "") {
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $client = new Client($sid, $token);
            // Send Message
            if ($request->user != null) {
                $user = User::find($request->user);
                if ($user) {
                    $client->messages->create(
                        '+1'.$user->phone,
                        array(
                            'from' => env('TWILIO_FROM'),
                            'body' => $request->message
                        )
                    );
                    return ($user->name);
                }
            } else if ($request->number != null) {
                $phone = $request->number;
                if (strlen($phone) == 10) {
                    $client->messages->create(
                        '+1'.$phone,
                        array(
                            'from' => env('TWILIO_FROM'),
                            'body' => $request->message
                        )
                    );
                    $phone = "(". substr($phone,0,3) .") " . substr($phone,3,3) . "-" .  substr($phone,6,4);
                    return($phone);
                }
            } else {
                return ('error');
            }
        }
    }
}
