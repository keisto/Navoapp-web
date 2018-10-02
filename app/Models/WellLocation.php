<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WellLocation extends Model
{
    use Searchable;

    public function hasFavored() {
        return $this->belongsToMany(User::class, "user_location_favorite", "location_id", 'user_id')->withTimestamps();
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
