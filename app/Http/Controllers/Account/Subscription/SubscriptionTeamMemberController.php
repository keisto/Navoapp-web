<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Requests\Account\SubscriptionTeamMemberStoreRequest;
use App\Http\Requests\Account\SubscriptionTeamUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class SubscriptionTeamMemberController extends Controller
{
    public function store(SubscriptionTeamMemberStoreRequest $request) {

        if ($this->teamLimitReached($request)) {
            return back()->with('error', 'You have reached the team limit for your plan.');
        }

        $request->user()->team->users()->syncWithoutDetaching([
            User::where('email', $request->email)->first()->id
        ]);

        return back()->with('success', 'Team member added.');
    }

    public function destroy(User $user, Request $request) {
        $request->user()->team->users()->detach($user->id);

        return back()->with('success', 'Team member was removed.');
    }

    protected function teamLimitReached($request) {
        return $request->user()->team->users->count() === $request->user()->subscription('main')->quantity;
    }
}
