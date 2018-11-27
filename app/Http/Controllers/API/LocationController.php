<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public $successStatus = 200;

    public function location() {
        $location = Location::find(request('location'));
        return response()->json(['success' => $location], $this->successStatus);
    }
}
