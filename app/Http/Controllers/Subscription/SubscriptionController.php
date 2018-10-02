<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class SubscriptionController extends Controller
{
    public function index() {
        $teamPlans = Plan::active()->team()->get();
        $soloPlans = Plan::active()->solo()->get();

        return view('subscription.index', compact('teamPlans', 'soloPlans'));
    }

    public function store(SubscriptionStoreRequest $request) {

        $subscription = $request->user()->newSubscription('main', $request->plan)->trialDays(3);

        if ($request->has('coupon')) {
            $subscription->withCoupon($request->coupon);
        }

        $subscription->create($request->token);

        return redirect('/search')->with('success', 'Thanks for becoming a subscriber.');
    }
}
