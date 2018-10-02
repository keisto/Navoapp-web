<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WellLocation;
use Illuminate\Support\Facades\DB;

class NavoController extends Controller
{
    protected $dates = array('date_modified');

    public function search() {
        $locations = WellLocation::all();
        $operators = $states = DB::table('well_locations')->distinct('current_operator')->count('current_operator');
        $states = DB::table('well_locations')->distinct('state')->count('state');
        $wells = WellLocation::count();

        if(auth()->user()->doesNotHaveSubscription()) {
            return redirect('plans.index')->with('error', 'Sorry, you\'ll need a plan to start searching.');
        }
        return view('search', compact('locations', 'operators', 'states', 'wells'));
    }

    public function detail($location) {
        $location = WellLocation::find($location);
        if ($location) {
            // Add Location to History


            return view('detail', compact('location'));
        } else {
            return redirect()->route('search')->with('error', 'Sorry, we couldn\'t find the location you were looking for.');
        }
    }
}
