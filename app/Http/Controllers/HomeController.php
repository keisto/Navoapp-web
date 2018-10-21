<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Location;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index() {
        $operators = $states = DB::table('locations')->distinct('operator')->count('operator');
        $states = DB::table('locations')->distinct('state')->count('state');
        $wells = Location::count();

        return view('home', compact('operators', 'states', 'wells'));
    }

    public function test() {
        $locations = Location::groupBy('state')->get();

        dd($locations);
        return view('test');
    }

}
