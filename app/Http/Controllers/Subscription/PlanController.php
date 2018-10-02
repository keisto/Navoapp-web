<?php

namespace App\Http\Controllers\Subscription;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index() {
        $teamPlans = Plan::active()->team()->get();
        $soloPlans = Plan::active()->solo()->get();
        return view('subscription.plans.index', compact('teamPlans', 'soloPlans'));
    }
}
