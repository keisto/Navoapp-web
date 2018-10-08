<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionInvoiceController extends Controller
{
    public function index() {
        $user = auth()->user();
//        $invoices = $user->invoices();

        $invoices = $user->invoicesIncludingPending();
//        dd($invoices);
        return view('account.subscription.invoice.index', compact('invoices'));
    }
}
