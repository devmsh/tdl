<?php

namespace Tests\Unit;

use App\Course;
use App\Interest;
use App\Timeslot;
use App\Trainer;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FailedCourses extends TestCase
{
    /**
     * Based on https://github.com/devmsh/tdl/issues/2
     * Scenario 1
     */
    public function test_system_send_notification_when_fail()
    {
        $trainer = factory(Trainer::class)->create();

        $course = factory(Course::class)->create([
            'trainer_id' => $trainer->id,
            'min_candidates' => 10,
        ]);

        $timeslot = factory(Timeslot::class)->create([
            'trainer_id' => $trainer->id,
            'start_date' => Carbon::now(),
            'weekdays' => 's,t,m',
            'from_time' => '3',
            'to_time' => '6',
        ]);

        $interest = factory(Interest::class)->create([
            'course_id' => $course->id,
            'timeslot_id' => $timeslot->id,
            'real_candidates' => 9,
        ]);

        $timeslot->valide();
    }
}
