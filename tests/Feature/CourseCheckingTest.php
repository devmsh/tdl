<?php

namespace Tests\Feature;

use App\Course;
use App\Interest;
use App\Jobs\CheckCourseJob;
use App\Notifications\FailedCourseNotification;
use App\Timeslot;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseCheckingTest extends TestCase
{
    use DatabaseMigrations;

    public function test_job_can_sent_notification_no_failed_courses()
    {
        // Arrange
        Notification::fake();

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

        // Act
        CheckCourseJob::dispatch();

        // Assert
        Notification::assertSentTo($interests,FailedCourseNotification::class);
    }

    /**
     *
     */
    public function test_job_must_not_sent_notification_no_successed_courses()
    {
        // Arrange
        Notification::fake();

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

        // Act
        CheckCourseJob::dispatch();

        // Assert
        Notification::assertNotSentTo($interests,FailedCourseNotification::class);
    }
}
