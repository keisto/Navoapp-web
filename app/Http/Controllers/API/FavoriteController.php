<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public $successStatus = 200;

    public function favorites() {
        $user = Auth::user();
        $favorites = $user->favorites()->orderByDesc('user_location_favorite.created_at')->get();
        return response()->json(['success' => $favorites], $this->successStatus);
    }

}
