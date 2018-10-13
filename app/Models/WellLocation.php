<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WellLocation extends Model
{
    use Searchable;

    public function notes() {
        return $this->belongsToMany(Note::class, "location_note", "location_id", 'note_id')
            ->orderByDesc('notes.updated_at')
            ->withTimestamps();
    }

    public function noteByUser() {
        return $this->hasOne(Note::class, "location_id")->where('user_id', '=', auth()->id());
//        $notes = $this->belongsToMany(Note::class, "location_note", "location_id", 'note_id')
//            ->withTimestamps()->get();
//
//        foreach ($notes as $note) {
//            if ($note->user_id == auth()->id() && $note->location_id == $this->id) {
//                return $note->get();
//            }
//        }
//        return null;
    }

    public function notesByTeamMembers()
    {
        $locationNotes = $this->notes()->get();
        $teamMemberNotes = array();
        $teams = auth()->user()->teams()->get();

        if (auth()->user()->hasTeamSubscription()) {
            // Owner looking at location
            $team = auth()->user()->team()->get()->first();
            foreach ($locationNotes as $note) {
                foreach ($team->users()->get() as $user) {
                    if ($note->user()->id == $user->id) {
                        $object = $note->teamMemberNote($user->id, $this->id);
                        if (!in_array($object, $teamMemberNotes)) {
                            array_push($teamMemberNotes, $object);
                        }
                    }
                }
            }
            if ($team->owner()->get()->first()->noteForLocation($this->id)) {
                $object = $team->owner()->get()->first()->noteForLocation($this->id)->get()->first();
                if ($object != null) {
                    if (!in_array($object, $teamMemberNotes)) {
                        array_push($teamMemberNotes, $object);
                    }
                }
            }
        } else {
            // Team Members loop
            foreach ($locationNotes as $note) {
                foreach ($teams as $team) {
                    foreach ($team->users()->get() as $user) {
                        if ($note->user()->id == $user->id) {
                            $object = $note->teamMemberNote($user->id, $this->id);
                            if (!in_array($object, $teamMemberNotes)) {
                                array_push($teamMemberNotes, $object);
                            }
                        }
                    }
                }
            }
            if ($team->owner()->get()->first()->noteForLocation($this->id) != null) {
                $object = $team->owner()->get()->first()->noteForLocation($this->id)->get()->first();
                if ($object != null) {
                    if (!in_array($object, $teamMemberNotes)) {
                        array_push($teamMemberNotes, $object);
                    }
                }
            }
        }



        return collect($teamMemberNotes);
    }

    public function hasFavored() {
        return $this->belongsToMany(User::class, "user_location_favorite", "location_id", 'user_id')
                    ->withTimestamps();
    }

    public function hasHistory() {
        return $this->belongsToMany(User::class, "user_location_history", "location_id", 'user_id')
                    ->withTimestamps();
    }

    public function isUsersHistory($user_id) {
        return DB::table('user_location_history')
            ->where('user_id', "=", $user_id)
            ->where("location_id", "=", $this->id)
            ->exists();
    }

    public function isFavoredByUser($user_id) {
       return DB::table('user_location_favorite')
           ->where('user_id', "=", $user_id)
           ->where("location_id", "=", $this->id)
           ->exists();
    }

    public function favoredOn($user_id) {
        if ($this->isFavoredByUser($user_id)) {
            $location = DB::table('user_location_favorite')
                ->where('user_id', "=", $user_id)
                ->where("location_id", "=", $this->id)
                ->get()->first();
            return Carbon::parse($location->updated_at)->diffForHumans();
        }
        return "";
    }
}
