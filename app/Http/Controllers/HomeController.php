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


        dd(auth()->user()->teamMembers());
        return view('test');
    }

}
