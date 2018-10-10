<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
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

        if ($location) {
            if ($location->closest_city == null) {
                $this->getLocationCity($location);
            }

            if ($location->isUsersHistory(auth()->id())) {
                auth()->user()->history()->detach($location->id);
                auth()->user()->history()->attach($location->id);
            } else {
                auth()->user()->history()->attach($location->id);
            }


            if (auth()->user()->hasOneCall()) {
                $intersection = $this->getIntersection($location);
                if ($intersection == null) {
                    $nearbyStreets = $this->getNearbyStreets($location);
                }
                if ($location->closest_city != null) {
                    $directions = $this->getDirections($location);
                }

            }


            return view('detail', compact('location', 'onecaller', 'intersection', 'nearbyStreets', 'directions'));
        } else {
            return redirect()->route('search')->with('error', 'Sorry, we couldn\'t find the location you were looking for.');
        }
    }

    public function locationCityStore($location, $city) {
        if (auth()->user()->hasSubscription()) {
            if ($location) {
                if ($location->closest_city == null) {
                    $location->closest_city = $city;
                    $location->save();
                }
            }
        }
    }

    public function getLocationCity($location) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?latlng=".
                $location->latitude .",". $location->longitude ."&key=". env('GOOGLE_MAP_KEY'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
            if (optional(json_decode($response))->results) {
                $results = json_decode($response)->results;
                $city = null;
                $city2 = null;
                foreach ($results[0]->address_components as $k => $v) {
                    if ($v->types[0] == "locality") {
                        $city = $v->long_name;
                    }
                    if (($v->types[0] == "neighborhood")) {
                        $city2 = $v->long_name;
                    }
                }
                if ($city == null) {
                    if ($city2 != null) {
                        $this->locationCityStore($location, $city2);
                        return $city2;
                    } else {
                        return null;
                    }
                } else {
                    $this->locationCityStore($location, $city);
                    return $city;
                }
            }
        }
        return null;
    }

    public function getIntersection($location) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.geonames.org/findNearestIntersectionJSON?formatted=true&lat=". $location->latitude ."&lng=". $location->longitude ."&username=keisto&style=full",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
            if (optional(json_decode($response))->intersection) {
                $streets = ['street1' => json_decode($response)->intersection->street1, 'street2' => json_decode($response)->intersection->street2];
                return (object)$streets;
            }
        }
        return null;
    }

    public function getNearbyStreets($location) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.geonames.org/findNearbyStreetsJSON?formatted=true&lat=". $location->latitude ."&lng=". $location->longitude ."&username=keisto&style=full",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "Cache-Control: no-cache"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
            $streets = [];
            if (optional(json_decode($response))->streetSegment) {
                foreach (json_decode($response)->streetSegment as $street) {
                    if (!in_array(optional($street)->name, $streets)) {
                        if (optional($street)->name) {
                            array_push($streets, $street->name);
                        }
                    }
                }
                return $streets;
            }
        }
        return null;
    }

    public function getDirections($location) {
        return $this->getNearbyCityCoordinates($location);
    }

    public function getNearbyCityCoordinates($location) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=".
                str_replace(" ", "+", $location->closest_city) ."+".
                str_replace(" ", "+", $location->state) ."&key=" . env('GOOGLE_MAP_KEY'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if (!$err) {
            if (optional(json_decode($response))->results[0]) {
                $latLon = ['lat' => json_decode($response)->results[0]->geometry->location->lat, 'lon' => json_decode($response)->results[0]->geometry->location->lng];
                return $this->getDrivingDirections($location, (object)$latLon);
            }
        }

        return null;
    }

    public function getDrivingDirections($location, $orgin) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/directions/json?origin=". $orgin->lat .",". $orgin->lon.
                "&destination=". $location->latitude .",". $location->longitude ."&key=". env('GOOGLE_MAP_KEY'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if (!$err) {
            if (optional(json_decode($response))->routes[0]) {
                return json_decode($response)->routes;
            }
        }
        return null;
    }
}
