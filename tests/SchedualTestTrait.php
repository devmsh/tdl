<?php

namespace Tests;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;

trait SchedualTestTrait
{
    var $timeExpressions = [
        'hourly' => '0 * * * * *',
        'everyFiveMinutes' => '*/5 * * * * *',
    ];

    public function timeToExpression($every)
    {
        return $this->timeExpressions[$every];
    }

    public function expressionToTime($every)
    {
        return array_flip($this->timeExpressions)[$every];
    }

    /**
     * @param $command
     * @param null $every
     */
    public function assertCommandScheduled($command, $every = null)
    {
        /** @var \Illuminate\Console\Scheduling\Schedule $schedule */
        $schedule = app()->make(Schedule::class);

        $events = collect($schedule->events())->filter(function (Event $event) use ($command) {
            return stripos($event->command, $command);
        });

        $this->assertTrue($events->isNotEmpty(),'No events found');

        if ($every) {
            $events->each(function (Event $event) use ($every) {
                $this->assertEquals($every, $this->expressionToTime($event->expression));
            });
        }
    }
}
