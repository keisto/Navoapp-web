<?php

//Route::get('/token', function () {
//    $token = auth()->user()->generateConfirmationToken();
////    dd($token);
//});
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');

/**
 * Plans
 */

Route::group(['prefix' => 'plans', 'as' => 'plans.'], function () {
    Route::get('/','Subscription\PlanController@index')->name('index');
//    Route::get('/teams','Subscription\PlanController@teams')->name('teams');
});
//Route::get('/purchase', 'PurchasesController@index.blade.php');
//Route::post('/purchase', 'PurchasesController@store');

/**
 * Account Activation
 */
Route::group(['prefix' => 'activation', 'middleware' => ['guest'], 'as' => 'activation.'], function () {
    Route::get('/resend','Auth\ActivationResendController@index')->name('resend');
    Route::post('/resend','Auth\ActivationResendController@store')->name('resend.store');
    Route::get('/{confirmation_token}','Auth\ActivationController@activate')->name('activate');
});

/**
 * Account Configuration
 */

Route::group(['prefix' => 'account', 'middleware' => ['auth'],
    'as' => 'account.', 'namespace' => 'Account'], function () {

    Route::get('/', 'AccountController@index')->name('index');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@store')->name('profile.store');

    Route::get('/password', 'PasswordController@index')->name('password.index');
    Route::post('/password', 'PasswordController@store')->name('password.store');

    Route::get('/deactivate', 'DeactivateController@index')->name('deactivate.index');
    Route::post('/deactivate', 'DeactivateController@store')->name('deactivate.store');

    Route::group(['prefix' => 'subscription', 'namespace' => 'Subscription', 'middleware' => ['subscription.owner']], function () {
        /**
         * Resume Service
         */
        Route::group(['middleware' => 'subscription.cancelled'], function () {
            Route::get('/resume', 'SubscriptionResumeController@index')->name('subscription.resume.index');
            Route::post('/resume', 'SubscriptionResumeController@store')->name('subscription.resume.store');
        });

        /**
         * Cancel Service or Change Plan
         */
        Route::group(['middleware' => 'subscription.notcancelled'], function () {
            Route::get('/cancel', 'SubscriptionCancelController@index')->name('subscription.cancel.index');
            Route::post('/cancel', 'SubscriptionCancelController@store')->name('subscription.cancel.store');
            Route::get('/plan', 'SubscriptionPlanController@index')->name('subscription.plan.index');
            Route::post('/plan', 'SubscriptionPlanController@store')->name('subscription.plan.store');
        });

        /**
         * Update Card
         */
        Route::group(['middleware' => 'subscription.customer'], function () {
            Route::get('/card', 'SubscriptionCardController@index')->name('subscription.card.index');
            Route::post('/card', 'SubscriptionCardController@store')->name('subscription.card.store');
        });

        /**
         * Manage Team
         */
        Route::group(['middleware' => 'subscription.team'], function () {
            Route::get('/team', 'SubscriptionTeamController@index')->name('subscription.team.index');
            Route::patch('/team', 'SubscriptionTeamController@update')->name('subscription.team.update');

            Route::post('/team/member', 'SubscriptionTeamMemberController@store')->name('subscription.team.member.store');
            Route::delete('/team/member/{user}', 'SubscriptionTeamMemberController@destroy')->name('subscription.team.member.destroy');
        });

    });
});

/**
 * Subscription Payment
 */
Route::group(['prefix' => 'subscription', 'as' => 'subscription.',
    'middleware' => ['auth.register', 'subscription.inactive']], function () {
    Route::get('/','Subscription\SubscriptionController@index')->name('index');
    Route::post('/','Subscription\SubscriptionController@store')->name('store');
});

/**
 * Membership Areas
 */
Route::group(['prefix' => '', 'middleware' => ['auth', 'subscription.active']], function () {
    Route::get('/search', 'NavoController@search')->name('search');
    Route::post('/location/favorite/{well_location}', 'Location\FavoriteController@store')->name('location.favorite.store');
    Route::get('/search', 'NavoController@search')->name('search');
    Route::get('/{id}', 'NavoController@detail')->name('detail');
});
