<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Interest extends Model
{
    use Notifiable;

    public function scopeWithIn($query, $course, $timeslot)
    {
        $query
            ->where('course_id',$course->id)
            ->where('timeslot_id',$timeslot->id);
    }
}
