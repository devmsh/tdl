<?php

namespace Tests;

use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertCommandScheduled($command, $every = null)
    {
        /** @var Schedule $scheduler */
        $scheduler = app()->make(Schedule::class);

        $events = collect($scheduler->events());
        $filteredEvents = $events->filter(function($event) use($command){
            return strstr($event->command,$command);
        });

        $this->assertGreaterThan(0,$filteredEvents->count(),
            "Command $command not scheduled");
    }

    public function apiActingAs($user = null)
    {
        $user = $user ?? factory(User::class)->create();
        Passport::actingAs(
            $user,
            ['*']
        );

        return $this;
    }
}
