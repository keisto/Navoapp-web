<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class SubscriptionController extends Controller
{
    public function index() {
        $plans = Plan::active()->get();

        return view('subscription.index', compact('plans'));
    }

    public function store(SubscriptionStoreRequest $request) {

        $subscription = $request->user()->newSubscription('main', $request->plan);

        if ($request->has('coupon')) {
            $subscription->withCoupon($request->coupon);
        }

        $plan = Plan::where('gateway_id', '=', $request->plan)->limit(1)->get()->first();
        if ($plan->teams_enabled) {
            $subscription->quantity($plan->teams_limit);
        } else {
            $subscription->trialDays(7);
        }

        $subscription->create($request->token);

        return redirect('/search')->with('success', 'Thanks for becoming a subscriber.');
    }
}
