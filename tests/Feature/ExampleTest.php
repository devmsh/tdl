<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TDLTest extends TestCase
{
    /***
     *  Scenario 1:
     *      Given we have a course
     *      And the course not have the enough interests
     *      When the interest deadline exceeded (7 days before the start at date)
     *      Then course candidates must be notified
     */

    /***
     *  Top down approach:
     *      We need to schedule a command
     *      The command must dispatch a Job
     *      The job must check the courses
     *      The failed courses candidates must be notified
     */

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
