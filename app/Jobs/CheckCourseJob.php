<?php

namespace App\Jobs;

use App\Interest;
use App\Notifications\FailedCourseNotification;
use App\Timeslot;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckCourseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Get all timeslots the exceed the deadline
        $timeslots = Timeslot::exceededDeadline()->get();

        //Get all courses within these timeslots
        foreach ($timeslots as $timeslot) {
            $courses = $timeslot->courses()->get();
            //Check each of these courses
            foreach ($courses as $course) {
                $real_interests = Interest::withIn($course,$timeslot)->get();

                //For the failed courses
                if(!$course->haveEnoughInterests($real_interests->count())){
                    //Send notification for the course candidates
                    $real_interests->each->notify(new FailedCourseNotification());
                }
            }
        }
    }
}
