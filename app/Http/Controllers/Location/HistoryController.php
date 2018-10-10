<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index() {
        $history = auth()->user()->history()->orderByDesc('user_location_history.created_at')->limit(100)->get();
        return view('location.history.index', compact('history'));
    }
}
