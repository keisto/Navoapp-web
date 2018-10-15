<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Auth\UserSignedUp' => [
            'App\Listeners\Auth\SendActivationEmail',
            'App\Listeners\Auth\CreateDefaultTeam',
        ],
        'App\Events\Auth\UserRequestedActivationEmail' => [
            'App\Listeners\Auth\SendActivationEmail',
        ],
        'App\Events\Auth\UserRequestedByTeamOwner' => [
            'App\Listeners\Auth\SendTeamActivationEmail',
            'App\Listeners\Auth\CreateDefaultTeam',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
