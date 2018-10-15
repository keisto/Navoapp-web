<?php

namespace App\Listeners\Auth;

use App\Mail\Auth\TeamActivationEmail;
use App\Mail\Auth\ActivationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendTeamActivationEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserRequestedByTeamOwner  $event
     * @return void
     */
    public function handle($event)
    {
//        Mail::to($event->user)->send(new ActivationEmail($event->user->generateConfirmationToken()));
        Mail::to($event->user)->send(new TeamActivationEmail($event->user->generateConfirmationToken(), $event->password));
    }
}
