<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::get('ephemeral', function () {
    if (!isset($_POST['api_version'])) {
        exit(http_response_code(400));
    }
    try {
        $key = \Stripe\EphemeralKey::create(
//            ["customer" => $customerId],
            ["stripe_version" => $_POST['api_version']]
        );
        header('Content-Type: application/json');
        exit(json_encode($key));
    } catch (Exception $e) {
        exit(http_response_code(500));
    }
});


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::post('logout', 'API\UserController@logout');

    Route::post('location', 'API\LocationController@location');
    Route::post('history', 'API\HistoryController@history');
    Route::post('favorites', 'API\FavoriteController@favorites');
});