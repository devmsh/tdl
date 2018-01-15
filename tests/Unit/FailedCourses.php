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

    protected function setUp()
    {
        parent::setUp();

        Notification::fake();
    }

    private function generateInterests($min_candidates, $start_date, $interests_count)
    {
        $this->course = factory(Course::class)->create([
            'min_candidates' => $min_candidates
        ]);

        $this->timeslot = factory(Timeslot::class)->create([
            'start_date' => $start_date
        ]);

        $this->interests = factory(Interest::class, $interests_count)->create([
            'course_id' => $this->course->id,
            'timeslot_id' => $this->timeslot->id
        ]);
    }

    /**
     * Based on https://github.com/devmsh/tdl/issues/2
     * Scenario 1
     */
    public function test_system_send_notification_when_exceed_deadline()
    {
        $this->generateInterests(
            10,
            Carbon::now()->addDays(Timeslot::VALIDATE_BEFORE),
            9
        );

        Timeslot::first()->validate();

        Notification::assertSentTo($this->course, DeadlineExceededNotification::class);
    }

    public function test_system_not_send_notification_when_not_exceed_deadline()
    {
        $this->generateInterests(
            10,
            Carbon::yesterday(),
            9
        );

        Timeslot::first()->validate();

        Notification::assertNotSentTo($this->course, DeadlineExceededNotification::class);
    }
}
