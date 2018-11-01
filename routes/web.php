<?php

use Illuminate\Http\Request;

Route::get('user/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor'  => 'Navo - oil well locator',
        'product' => auth()->user()->plan()->name ." - ".
            auth()->user()->plan()->price ." (".
            auth()->user()->plan()->recurring .")"
    ]);
});

//Route::get('/mailable', function () {
//    return new App\Mail\Auth\TeamActivationEmail("s", "afds");
//});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');

/**
 * Plans
 */
//
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
    Route::get('/{confirmation_token}/team','Auth\ActivationController@teamActivate')->name('activate.team');
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

    Route::get('/agreement', 'ProfileController@terms')->name('agreement.terms');

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
            Route::post('/plan/increase', 'SubscriptionPlanController@increase')->name('subscription.plan.increase');
        });

        /**
         * Update Card
         */
        Route::group(['middleware' => 'subscription.customer'], function () {
            Route::get('/invoice', 'SubscriptionInvoiceController@index')->name('subscription.invoice.index');
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
Route::group(['prefix' => '', 'middleware' => ['auth', 'subscription.active', 'legal.terms']], function () {

    /**
     * Favorite Locations
     */
    Route::get('/location/favorite', 'Location\FavoriteController@index')->name('location.favorite.index');
    Route::post('/location/favorite/{well_location}', 'Location\FavoriteController@store')->name('location.favorite.store');
    /**
     * Location History
     */
    Route::get('/location/history', 'Location\HistoryController@index')->name('location.history.index');
    Route::post('/location/history/{well_location}', 'Location\HistoryController@store')->name('location.history.store');
//    Route::get('/search', 'NavoController@search')->name('search');
    /**
     * Location Search & Details
     */
    Route::get('/search', 'NavoController@search')->name('search');
    Route::get('/{id}', 'NavoController@detail')->name('detail');
    /**
     * Location Notes
     */
    Route::post('/location/note/{id}', 'Location\NoteController@store')->name('location.note.store');
    /**
     * Share - Text Message
     */
    Route::post('/location/share/message', 'Location\MessageController@store')->name('location.share.message.store');
    /**
     * Team Members
     */
    Route::get('/team/members', 'Team\TeamController@index')->name('team.members.index');
});
