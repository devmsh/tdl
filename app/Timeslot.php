<?php

namespace App;

use App\Notifications\DeadlineExceededNotification;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Timeslot extends Model
{
    const VALIDATE_BEFORE = 7;

    protected $dates = [
        'start_date'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'interests')->distinct();
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function isExceedDeadline()
    {
        return Carbon::now()->diffInDays($this->start_date,false) >= 7;
    }

    public function validate()
    {
        if(!$this->isExceedDeadline())return;

        foreach ($this->courses as $course){
            $real_candidates_count = Interest::where('course_id', $course->id)
                ->where('course_id', $course->id)
                ->count();

            if($real_candidates_count < $course->min_candidates){
                $interests = Interest::where('course_id', $course->id)
                    ->where('course_id', $course->id)
                    ->get();

                $interests->each(function ($interest){
                    $interest->notify(new DeadlineExceededNotification());
                });
            }
        }

    }
}
