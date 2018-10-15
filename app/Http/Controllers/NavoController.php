<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Location\OneCallController;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\WellLocation;
use App\Models\Note;
use Illuminate\Support\Facades\DB;

class NavoController extends Controller
{
    protected $dates = array('date_modified');

    public function search() {
        $locations = WellLocation::all();
        $operators = $states = DB::table('well_locations')->distinct('current_operator')->count('current_operator');
        $states = DB::table('well_locations')->distinct('state')->count('state');
        $wells = WellLocation::count();
        $agent = new Agent();
        if(auth()->user()->doesNotHaveSubscription()) {
            return redirect('plans.index')->with('error', 'Sorry, you\'ll need a plan to start searching.');
        }
        return view('search', compact('locations', 'operators', 'states', 'wells', 'agent'));
    }

    public function detail($location) {
        $location = WellLocation::find($location);
        $onecaller = !auth()->user()->hasOneCall() ? "1" : "0";
        $nearbyStreets = null;
        $intersection = null;
        $directions = null;
        $notes = null;

        if ($location) {
            if ($location->closest_city == null) {
                OneCallController::getLocationCity($location);
            }

            if ($location->isUsersHistory(auth()->id())) {
                auth()->user()->history()->detach($location->id);
                auth()->user()->history()->attach($location->id);
            } else {
                auth()->user()->history()->attach($location->id);
            }

            if (auth()->user()->hasOneCall()) {
                $intersection = OneCallController::getIntersection($location);
                if ($intersection == null) {
                    $nearbyStreets = OneCallController::getNearbyStreets($location);
                }
                if ($location->closest_city != null) {
                    $directions = OneCallController::getDirections($location);
                }
            }

            $teams = auth()->user()->teams()->get();
            if (auth()->user()->hasPiggybackSubscription() && count($teams) || auth()->user()->hasTeamSubscription()) {
                $notes = $location->notesByTeamMembers()->sortByDesc('updated_at');
            } else {
                $notes = $location->noteByUser()->get();
            }

            $teamMembers = auth()->user()->teamMemberNumbers();

            return view('detail', compact('location', 'onecaller',
                'intersection', 'nearbyStreets', 'directions', 'notes', 'teamMembers'));
        } else {
            return redirect()->route('search')->with('error', 'Sorry, we couldn\'t find the location you were looking for.');
        }
    }

}
