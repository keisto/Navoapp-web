<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WellLocation;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index() {
        $operators = $states = DB::table('well_locations')->distinct('current_operator')->count('current_operator');
        $states = DB::table('well_locations')->distinct('state')->count('state');
        $wells = WellLocation::count();

        return view('home', compact('operators', 'states', 'wells'));
    }

    public function test() {
//        $location = WellLocation::find(90941);
//        ->attach(auth()->user());
//        auth()->user()->favorites()->attach($location);

//        dd(auth()->user()->favorites()->get());

//        dd($location->hasFavored()->get()->count());
        dd(auth()->user()->isFavorite(90941));
        return view('test');
    }

//    public function index.blade.php() {
//        $day = \Carbon\Carbon::now()->format('Y-m-d');
//        $dispatches = Dispatch::dispatch()->with('items')->day($day)->group()->get();
//        return view('dispatch.index.blade.php', compact('dispatches', 'day'));
////    }
}
