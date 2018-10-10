<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index() {
        $user = auth()->user();
        $teams = array();
        foreach ($user->teams as $team) {
            if (optional($team->owner)->hasSubscription()) {
                $ar = array();
                $ar["name"] = $team->name;
                $ar["owner"] = $team->owner->name;
                $ar["email"] = $team->owner->email;
                array_push($teams, (object) $ar);
            }
        }

        return view('account.index', compact('user', 'teams'));
    }
}
