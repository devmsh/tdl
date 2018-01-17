<?php

namespace Tests\Feature;

use App\Jobs\TimeslotsCheck;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeslotsCheckTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_check_job_can_be_queued()
    {
        Queue::fake();

        $this->artisan("tdl:check");

        Queue::assertPushed(TimeslotsCheck::class);
    }

    public function test_check_scheduled_every_hour()
    {
        $this->assertCommandScheduled('tdl:check', 'hourly');
    }
}
