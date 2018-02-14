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

class InterestTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_get_the_intereted_list_for_these_course()
    {
        $course = factory(Course::class)->create([
            'min_candidates' => 10
        ]);

        $first_timeslot = factory(Timeslot::class)->create([
            'start_at' => Carbon::now()
        ]);

        $second_timeslot = factory(Timeslot::class)->create([
            'start_at' => Carbon::now()
        ]);

        $first_timeslot_interests = factory(Interest::class,9)->create([
            'course_id' => $course->id,
            'timeslot_id' => $first_timeslot->id,
        ]);

        $second_timeslot_interests = factory(Interest::class,7)->create([
            'course_id' => $course->id,
            'timeslot_id' => $second_timeslot->id,
        ]);

        $this->assertCount(9,Interest::withIn($course,$first_timeslot)->get());
        $this->assertCount(7,Interest::withIn($course,$second_timeslot)->get());
    }
}
