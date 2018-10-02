<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Requests\Subscription\SubscriptionPlanStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;

class SubscriptionPlanController extends Controller
{
    public function index() {
        $plans = Plan::except(auth()->user()->plan->id)->active()->get();
        return view('account.subscription.plan.index', compact('plans'));
    }

    public function store(SubscriptionPlanStoreRequest $request) {
        $user = $request->user();

        $plan = Plan::where('gateway_id', $request->plan)->first();

        if ($this->downgradesFromTeamPlan($user, $plan)) {
//            $user->team->users()->each(function () {
//               // Mail each user to let them know it was cancelled...
//            });

            $user->team->users()->detach();
        }

        $user->subscription('main')->swap($plan->gateway_id);

        return back()->with('success', 'Your subscription was updated successfully.');
    }

    protected function downgradesFromTeamPlan(User $user, Plan $plan) {
        if ($user->plan->isForTeams() && $plan->isNotForTeams()) {
            return true;
        }
        return false;
    }

}
