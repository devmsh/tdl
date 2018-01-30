<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CoursesTest extends DuskTestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/courses/create')
                ->type('name','PHP Course')
                ->click('#add_course')
                ->assertRouteIs('courses.show',['id'=>1]);
        });

        $this->assertCount(1,Course::all());
    }
}
