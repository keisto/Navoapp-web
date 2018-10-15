<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\ProfileStoreRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index() {
        return view('account.profile.index');
    }

    public function store(ProfileStoreRequest $request) {
        $request->user()->update($request->only(['name', 'email', 'phone']));
        return redirect()->route('account.index')->with('success', 'Profile details updated.');
    }
}
