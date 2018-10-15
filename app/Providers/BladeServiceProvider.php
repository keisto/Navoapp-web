<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('subscribed', function() {
            return auth()->user()->hasSubscription();
        });
        Blade::if('notsubscribed', function() {
            return !auth()->check() || auth()->user()->doesNotHaveSubscription();
        });
        Blade::if('hasonecall', function() {
            return auth()->user()->hasOneCall();
        });


        Blade::if('notcancelled', function() {
            return auth()->user()->hasNotCancelled();
        });
        Blade::if('cancelled', function() {
            return auth()->user()->hasCancelled();
        });
        Blade::if('customer', function() {
            return auth()->user()->isCustomer();
        });
        Blade::if('teamsubscription', function() {
           return auth()->user()->hasTeamSubscription();
        });
        Blade::if('notpiggybacksubscription', function() {
            return !auth()->user()->hasPiggybacksubscription();
        });
        Blade::if('piggybacksubscription', function() {
            return auth()->user()->hasPiggybacksubscription();
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
