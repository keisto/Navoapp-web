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
        $locations =  DB::table('locations');
        $operators = $locations->distinct('operator')->count('operator');
        $states = $locations->distinct('state')->count('state');
        $wells = $locations->count();
        $eachStateCount = $locations
            ->select('state as name', DB::raw('count(*) as total'))
            ->groupBy('state')
            ->get();

        return view('home', compact('operators', 'states', 'wells', 'eachStateCount'));
    }

    public function test() {
        $locations = Location::groupBy('state')->get();

        dd($locations);
        return view('test');
    }

}
