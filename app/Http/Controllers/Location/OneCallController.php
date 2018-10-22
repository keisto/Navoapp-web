<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OneCallController extends Controller
{
    static public function locationCityStore($location, $city) {
        if (auth()->user()->hasSubscription()) {
            if ($location) {
                if ($location->city == null) {
                    $location->city = $city;
                    $location->save();
                }
            }
        }
    }

    static public function getLocationCity($location) {
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
                        OneCallController::locationCityStore($location, $city2);
                        return $city2;
                    } else {
                        return null;
                    }
                } else {
                    OneCallController::locationCityStore($location, $city);
                    return $city;
                }
            }
        }
        return null;
    }

    static public function getIntersection($location) {
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

   static public function getNearbyStreets($location) {

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
                if (count($streets) == 0) {
                    $name = optional(json_decode($response)->streetSegment)->name;
                    array_push($streets, $name);
                }
                return $streets;
            }
        }
        return null;
    }

    static public function getDirections($location) {
        return OneCallController::getNearbyCityCoordinates($location);
    }

    static public function getNearbyCityCoordinates($location) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=".
                str_replace(" ", "+", $location->city) ."+".
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
                return OneCallController::getDrivingDirections($location, (object)$latLon);
            }
        }

        return null;
    }

    static public function getDrivingDirections($location, $origin) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/directions/json?origin=". $origin->lat .",". $origin->lon.
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
