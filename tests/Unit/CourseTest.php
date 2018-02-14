<?php

namespace Tests\Unit;

use App\Course;
use App\Interest;
use App\Timeslot;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use DatabaseMigrations;

    public function test_the_course_can_have_not_enough_interests()
    {
        $course = factory(Course::class)->create([
            'min_candidates' => 10
        ]);

        $timeslot = factory(Timeslot::class)->create([
            'start_at' => Carbon::now()
        ]);

        $interests = factory(Interest::class,9)->create([
            'course_id' => $course->id,
            'timeslot_id' => $timeslot->id,
        ]);

        $real_candidates = Interest::withIn($course,$timeslot)->get();
        $this->assertFalse($course->haveEnoughInterests($real_candidates->count()));
    }

    public function test_the_course_can_have_enough_interests()
    {
        $course = factory(Course::class)->create([
            'min_candidates' => 10
        ]);

        $timeslot = factory(Timeslot::class)->create([
            'start_at' => Carbon::now()
        ]);

        $interests = factory(Interest::class,10)->create([
            'course_id' => $course->id,
            'timeslot_id' => $timeslot->id,
        ]);

        $real_candidates = Interest::withIn($course,$timeslot)->get();
        $this->assertTrue($course->haveEnoughInterests($real_candidates->count()));
    }
}
