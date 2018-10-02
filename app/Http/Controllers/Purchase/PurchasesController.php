<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class PurchasesController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index() {

        return view('purchase.index.blade.php');
    }

    public function store() {
        Stripe::setApiKey(config('services.stripe.secret'));
        $customer = Customer::create([
            'email' => request('stripeEmail'),
            'source' => request('stripeToken')
        ]);

        Charge::create([
            'customer' => $customer->id,
            'amount' => '2500',
            'currency' => 'usd'
        ]);
        dump(request()->all());

        dd();
    }


    }
