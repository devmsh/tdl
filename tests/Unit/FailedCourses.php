<?php

namespace Tests\Unit;

use App\Course;
use App\Interest;
use App\Notifications\DeadlineExceededNotification;
use App\Timeslot;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class FailedCourses extends TestCase
{
    use DatabaseMigrations;

    /**
     * Based on https://github.com/devmsh/tdl/issues/2
     * Scenario 1
     */
    public function test_system_send_notification_when_exceed_deadline()
    {
        $course = factory(Course::class)->create([
            'min_candidates' => 10
        ]);

        $timeslot = factory(Timeslot::class)->create([
            'start_date' => Carbon::now()->addDays(Timeslot::VALIDATE_BEFORE)
        ]);

        factory(Interest::class, 9)->create([
            'course_id' => $course->id,
            'timeslot_id' => $timeslot->id
        ]);

        Notification::fake();

        Timeslot::first()->validate();

        Notification::assertSentTo($course, DeadlineExceededNotification::class);
    }

    public function test_system_not_send_notification_when_not_exceed_deadline()
    {
        $course = factory(Course::class)->create([
            'min_candidates' => 10
        ]);

        $timeslot = factory(Timeslot::class)->create([
            'start_date' => Carbon::yesterday()
        ]);

        factory(Interest::class, 9)->create([
            'course_id' => $course->id,
            'timeslot_id' => $timeslot->id
        ]);

        Notification::fake();

        Timeslot::first()->validate();

        Notification::assertNotSentTo($course, DeadlineExceededNotification::class);
    }
}
