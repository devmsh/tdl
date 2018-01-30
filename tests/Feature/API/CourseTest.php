<?php

namespace Tests\Feature\API;

use App\Course;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_get_courses()
    {
        factory(Course::class,100)->create();

        $res = $this->get('api/courses');

        $res->assertSuccessful();
        $this->assertCount(25, $res->json()['data']);
        $res->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "name",
                ]
            ],
            "meta",
            "links"
        ]);
    }

    public function test_can_create_course()
    {
        $course = factory(Course::class)->make([
            'name' => 'PHP Course'
        ]);

        $res = $this->post('api/courses',$course->toArray());

        $res->assertSuccessful();
        $this->assertCount(1,Course::all());

        $course = Course::first();
        $this->assertEquals('PHP Course',$course->name);
        $res->assertJsonStructure([
            "data" => [
                "id",
                "created_at"
            ]
        ]);
    }

    public function test_course_name_required()
    {
        $course = factory(Course::class)->make([
            'name' => null
        ]);

        $res = $this->post('api/courses',$course->toArray());

        $res->assertStatus(422);
        $this->assertCount(0,Course::all());
    }
}
