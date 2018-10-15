<?php

namespace App\Http\Controllers\Auth;

use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ActivationController extends Controller
{
    public function __construct() {
        $this->middleware(['confirmation_token.expired:/']);
    }
    protected $redirectTo = '/search';

    public function activate(ConfirmationToken $token, Request $request) {
        $token->user->update([
            'activated' => true
        ]);

        Auth::loginUsingId($token->user->id);

        return redirect()->intended($this->redirectedPath())->with('success', 'You are now logged in.');
    }

    protected function redirectedPath() {
        return $this->redirectTo;
    }

    public function teamActivate(ConfirmationToken $token, Request $request)
    {
        $token->user->update([
            'activated' => true
        ]);

        Auth::loginUsingId($token->user->id);

        return redirect()->route('account.password.index')->with('warning', 'You should update your password with something you can easily remember.');
    }

}
