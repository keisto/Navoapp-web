<?php

namespace App\Models;

use App\Models\WellLocation;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user() {
        return $this->belongsTo(User::class)->get()->first();
    }

    public function location() {
        return $this->belongsToMany(WellLocation::class, "location_note", "note_id", "location_id")->withTimestamps();
    }

    public function scopeTeamMemberNote($builder, $user_id, $location_id) {

//        dd(Note::with('location_note')->get());
//        ->where('location_note.location_id', '=',$location_id)

        return $builder->where('user_id', '=', $user_id)
                        ->where('location_id', '=', $location_id)
                        ->limit(1)->get()->first();
    }

//    public function memberNote($user_id, $location_id) {
//
//        dd(Note::with('location_note')->get());
////        return $builder->where('user_id', '=', $user_id)->where('location_note.location_id', '=',$location_id)->limit(1)->get()->first();
//    }
}
