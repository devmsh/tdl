<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    const VALIDATE_BEFORE_DAYS = 7;

    public function scopeExceededDeadline($query)
    {
        $query->where('start_at','<',Carbon::now()->addDays(self::VALIDATE_BEFORE_DAYS));
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,"interests")->distinct();
    }
}
