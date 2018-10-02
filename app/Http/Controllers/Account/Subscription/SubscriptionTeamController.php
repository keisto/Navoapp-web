<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Requests\Account\SubscriptionTeamUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionTeamController extends Controller
{
    public function index(Request $request) {
        $team = $request->user()->team;
        return view('account.subscription.team.index', compact('team'));
    }

    public function update(SubscriptionTeamUpdateRequest $request) {
        $request->user()->team()->update($request->only(['name']));

        return back()->with('success', 'Team name updated.');
    }
}
