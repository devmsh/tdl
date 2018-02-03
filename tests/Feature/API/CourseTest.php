<?php

namespace Tests\Feature\API;

use App\Course;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_must_be_authenticated()
    {
        factory(Course::class,100)->create();

        $res = $this->json('get','api/courses');

        $res->assertStatus(401);
    }

    public function test_can_get_courses()
    {
        factory(Course::class,100)->create();

        $res = $this->apiActingAs()->json('get','api/courses');

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

    public function test_course_name_required()
    {
        $this->withoutExceptionHandling();

        $course = factory(Course::class)->make([
            'name' => null
        ]);

        $res = $this->apiActingAs()->json('post','api/courses',$course->toArray());

        $res->assertStatus(422);
        $this->assertCount(0,Course::all());
    }

    public function test_can_create_course()
    {
        $course = factory(Course::class)->make([
            'name' => 'PHP Course'
        ]);

        $res = $this->apiActingAs()->json('post','api/courses',$course->toArray());

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

    public function test_can_update_my_course()
    {
        $trainer = factory(User::class)->create();

        $course = factory(Course::class)->create([
            'name' => 'PHP Course',
            'trainer_id' => $trainer->id
        ]);

        $res = $this->apiActingAs($trainer)->json('put','api/courses/'.$course->id,[
            'name' => 'TDD PHP Course',
        ]);

        $res->assertSuccessful();
        $this->assertCount(1,Course::all());

        $course = Course::first();
        $this->assertEquals('TDD PHP Course',$course->name);
        $res->assertJsonStructure([
            "data" => [
                "id",
                "created_at"
            ]
        ]);
    }

    public function test_can_update_other_trainer_courses()
    {
        $trainer = factory(User::class)->create();

        $course = factory(Course::class)->create([
            'name' => 'PHP Course',
            'trainer_id' => $trainer->id
        ]);

        $res = $this->apiActingAs()->json('put','api/courses/'.$course->id,[
            'name' => 'TDD PHP Course',
        ]);

        $res->assertStatus(403);
    }
}
