<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $password;

    public function __construct($token, $password) {
        $this->password = $password;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Please activate your team member account')->markdown('emails.auth.team_activation');
    }
}
