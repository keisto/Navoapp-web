<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public $successStatus = 200;

    public function history() {
        $user = Auth::user();
        $history = $user->history()->orderByDesc('user_location_history.created_at')->limit(100)->get();
        return response()->json(['success' => $history], $this->successStatus);
    }
}
