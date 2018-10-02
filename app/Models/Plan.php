<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{
    public function isForTeams() {
        return $this->teams_enabled;
    }

    public function isNotForTeams() {
        return !$this->isForTeams();
    }

    public function scopeTeam(Builder $builder) {
        return $builder->where('teams_enabled', true);
    }

    public function scopeSolo(Builder $builder) {
        return $builder->where('teams_enabled', false);
    }

//    public function scopeMonthly(Builder $builder) {
//        return $builder->where('active', true);
//    }
//    public function scopeYearly(Builder $builder) {
//        return $builder->where('active', true);
//    }

    public function scopeActive(Builder $builder) {
        return $builder->where('active', true);
    }

    public function scopeExcept(Builder $builder, $planId) {
        return $builder->where('id', '!=', $planId);
    }
}
