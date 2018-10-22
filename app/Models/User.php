<?php

namespace App\Models;

use App\Models\Traits\HasConfirmationTokens;
use App\Models\Traits\HasSubscriptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;

class User extends Authenticatable
{
    use Notifiable, HasConfirmationTokens, Billable, HasSubscriptions, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activated', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasActivated() {
        return $this->activated;
    }

    public function hasNotActivated() {
        return !$this->hasActivated();
    }

    public function team() {
        return $this->hasOne(Team::class);
    }

    public function favorites() {
        return $this->belongsToMany(Location::class,"user_location_favorite", "user_id", "location_id")->withTimestamps();
    }

    public function history() {
        return $this->belongsToMany(Location::class,"user_location_history", "user_id", "location_id")->withTimestamps();
    }

    public function noteForLocation($location_id) {
        return $this->hasOne(Note::class)->where('location_id', '=', $location_id);
    }

    public function isLocationFavorite($id) {
        $location = Location::find($id);
        if ($location) {
            return $location->isFavoredByUser(auth()->id());
        }
        return false;
    }

    public function plan() {
        return $this->plans->first();
    }

    public function getPlanAttribute() {
        return $this->plan();
    }

    public function plans() {
        return $this->hasManyThrough(Plan::class, Subscription::class,
            'user_id', 'gateway_id', 'id', 'stripe_plan'
        )->orderBy('subscriptions.created_at', 'desc');
    }

    public function teams() {
        return $this->belongsToMany(Team::class);
    }

    public function teamMembers () {
        $teamMembers = array();
        $teams = $this->teams()->get();
        if (auth()->user()->hasPiggybackSubscription() && count($teams)) {
            foreach ($teams as $team) {
                foreach ($team->users()->get() as $user) {
                    if (!in_array($user, $teamMembers)) {
                        array_push($teamMembers, $user);
                    }
                }
                if (!in_array($team->owner()->get()->first(), $teamMembers)) {
                    array_push($teamMembers, $team->owner()->get()->first());
                }
            }
            return (object) $teamMembers;
        } else if (auth()->user()->hasTeamSubscription()) {
            $team = auth()->user()->team()->get()->first();
            foreach ($team->users()->get() as $user) {
                if (!in_array($user, $teamMembers)) {
                    array_push($teamMembers, $user);
                }

            }
            // add self as team owner
            array_push($teamMembers, auth()->user());
            return (object) $teamMembers;
        } else {
            return null;
        }
    }

    public function teamMemberNumbers() {
        // Get team members with phone numbers ONLY
        $teamMembers = array();
        $teams = $this->teams()->get();
        if (auth()->user()->hasPiggybackSubscription() && count($teams)) {
            foreach ($teams as $team) {
                foreach ($team->users()->get() as $user) {
                    if ($user->phone != null) {
                        if (!in_array($user, $teamMembers)) {
                            array_push($teamMembers, $user);
                        }
                    }
                }
                if (!in_array($team->owner()->get()->first(), $teamMembers)) {
                    if ($team->owner()->get()->first()->phone != null) {
                        array_push($teamMembers, $team->owner()->get()->first());
                    }
                }
            }
            return (object) $teamMembers;
        } else if (auth()->user()->hasTeamSubscription()) {
            $team = auth()->user()->team()->get()->first();
            foreach ($team->users()->get() as $user) {
                if (!in_array($user, $teamMembers)) {
                    if ($user->phone != null) {
                        array_push($teamMembers, $user);
                    }
                }

            }
            // add self as team owner
            if (auth()->user()->phone != null) {
                array_push($teamMembers, auth()->user());
            }
            return (object) $teamMembers;
        } else {
            return null;
        }
    }

    public function getPhoneNumberAttribute() {
        $phone = $this->phone;
        return "(". substr($phone,0,3) .") " . substr($phone,3,3) . "-" .  substr($phone,6,4);
    }
}
