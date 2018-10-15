<?php

namespace App\Http\Controllers\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index() {
        $teamMembers = auth()->user()->teamMembers();
        return view('team.index', compact('teamMembers'));
    }
}
