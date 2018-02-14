<?php

namespace Tests\Feature;

use App\Console\Commands\CheckCourseCommand;
use App\Jobs\CheckCourseJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckCourseCommandTest extends TestCase
{
    public function test_laravel_schedule_course_check_command_daily()
    {
        $commandName = (new CheckCourseCommand())->getName();
        $this->assertEquals("tdl:checkcourse",$commandName);
        $this->assertCommandScheduled($commandName ,"daily");
    }

    public function test_command_dipatch_the_job()
    {
        Queue::fake();

        Artisan::call((new CheckCourseCommand())->getName());

        Queue::assertPushed(CheckCourseJob::class);
    }
}
