<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if ($user->hasSubscription()) {
                $success['token'] =  $user->createToken('mobile')->accessToken;
                return response()->json(['success' => $success], $this->successStatus);
            } else {
                return response()->json(['error'=>'Subscription'], 401);
            }
        } else {
            return response()->json(['error'=>'Unauthorized'], 401);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('mobile')-> accessToken;
            $success['name'] =  $user->name;

            return response()->json(['success'=>$success], $this->successStatus);
        }
    }

    public function details() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function logout() {
        $user = Auth::user();
        foreach($user->tokens as $token) {
            $token->revoke();
        }
    }
}
