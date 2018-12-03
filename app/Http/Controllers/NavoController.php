<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Location\OneCallController;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\Location;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastOnce;

class NavoController extends Controller
{

    public function search() {
//        $locations = Location::all();
//        $operators = $states = DB::table('locations')->distinct('operator')->count('operator');
//        $states = DB::table('locations')->distinct('state')->count('state');
//        $wells = Location::count();
        $agent = new Agent();
        if(auth()->user()->doesNotHaveSubscription()) {
            return redirect('plans.index')->with('error', 'Sorry, you\'ll need a plan to start searching.');
        }
//        return view('search', compact('locations', 'operators', 'states', 'wells', 'agent'));
        return view('search', compact( 'agent'));
    }

    public function detail($location) {
        $location = Location::find($location);
        $onecaller = !auth()->user()->hasOneCall() ? "1" : "0";
        $nearbyStreets = null;
        $intersection = null;
        $directions = null;
        $notes = null;

        if ($location) {
            if ($location->city == null) {
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
                if ($location->city != null) {
                    $directions = OneCallController::getDirections($location);
                }
                // Try to get Section, Range, and Township
                if ($location->section == null || $location->section == "NULL") {
                    OneCallController::getTownshipSectionRange($location, $location->latitude, $location->longitude);
                }
            }

            $teams = auth()->user()->teams()->get();
            if (auth()->user()->hasPiggybackSubscription() && count($teams) || auth()->user()->hasTeamSubscription()) {
                $notes = $location->notesByTeamMembers()->sortByDesc('updated_at');
            } else {
                $notes = $location->noteByUser()->get();
            }

            $teamMembers = auth()->user()->teamMemberNumbers();

            $nearby = $location->nearby();

            return view('detail', compact('location', 'onecaller',
                'intersection', 'nearbyStreets', 'directions', 'notes', 'teamMembers', 'nearby'));
        } else {
            return redirect()->route('search')->with('error', 'Sorry, we couldn\'t find the location you were looking for.');
        }
    }

}
