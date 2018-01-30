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

class TimeslotTest extends TestCase
{
    use DatabaseMigrations;

    public function test_we_can_get_the_exceeded_timeslots()
    {
        $first = factory(Timeslot::class)->create([
            'start_at' => Carbon::now()
        ]);
        $second = factory(Timeslot::class)->create([
            'start_at' => Carbon::tomorrow()
        ]);
        $third = factory(Timeslot::class)->create([
            'start_at' => Carbon::now()->addDays(Timeslot::VALIDATE_BEFORE_DAYS + 1)
        ]);

        $timeslots = Timeslot::exceededDeadline()->get();

        $this->assertCount(2,$timeslots);
        $this->assertEquals($first->id,$timeslots[0]->id);
        $this->assertEquals($second->id,$timeslots[1]->id);
    }

    public function test_timeslot_can_get_its_own_courses()
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

        $this->assertCount(1, $timeslot->courses()->get());
    }
}
