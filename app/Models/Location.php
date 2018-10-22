<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    use Searchable;

    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['_geoloc'] = [
            'lat' => $record['latitude'],
            'lng' => $record['longitude'],
        ];
        // Remove unnecessary data
        unset($record['section'], $record['range'], $record['township'], $record['country']);
        unset($record['created_at'], $record['updated_at']);
        unset($record['latitude'], $record['longitude']);

        return $record;
    }
    public function notes() {
        return $this->belongsToMany(Note::class, "location_note", "location_id", 'note_id')
            ->orderByDesc('notes.updated_at')
            ->withTimestamps();
    }

    public function noteByUser() {
        return $this->hasOne(Note::class, "location_id")->where('user_id', '=', auth()->id());
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
                    if ($team->owner()->get()->first()->noteForLocation($this->id) != null) {
                        $object = $team->owner()->get()->first()->noteForLocation($this->id)->get()->first();
                        if ($object != null) {
                            if (!in_array($object, $teamMemberNotes)) {
                                array_push($teamMemberNotes, $object);
                            }
                        }
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

    public function nearby() {
        $lat= $this->latitude;
        $lng= $this->longitude;
        $max_distance = 5;
        // $circle_radius = 3959;
        $selected = "(6371 * acos(cos(radians(" . $lat . ")) 
                    * cos(radians(`latitude`)) 
                    * cos(radians(`longitude`) 
                    - radians(" . $lng . ")) 
                    + sin(radians(" . $lat . ")) 
                    * sin(radians(`latitude`))))";

        return Location::select('id', 'name', 'operator', 'latitude', 'longitude')
            ->selectRaw("{$selected} AS distance")
            ->whereRaw("{$selected} < ?", [$max_distance])->get();
    }
}
