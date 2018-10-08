<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('account.index', compact('user'));
    }
}
