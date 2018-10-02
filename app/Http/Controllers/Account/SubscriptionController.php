<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function card() {
        return view('account.subscription.card.index');
    }

    public function plan() {
        return view('account.subscription.plan.index');
    }

    public function cancel() {
        return view('account.subscription.cancel.index');
    }

    public function resume() {
        return view('account.subscription.resume.index');
    }
}
