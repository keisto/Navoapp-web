<?php

namespace App\Http\Controllers\Location;

use App\Models\WellLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index() {
        $favorites = auth()->user()->favorites()->orderByDesc('user_location_favorite.created_at')->get();
        return view('location.favorite.index', compact('favorites'));
    }

    public function store($location) {
        $location = WellLocation::find($location);
        if ($location) {
            if(auth()->user()->isLocationFavorite($location->id)) {
                auth()->user()->favorites()->detach($location->id);
                return('removed');
            } else {
                auth()->user()->favorites()->attach($location->id);
                return('added');
            }
        } else {
            return('error');
        }
    }
}
