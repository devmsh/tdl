<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\TestRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Course::class);
    }

    public function index()
    {
        $per_page = config('tdl.per_page');
        return CourseResource::collection(Course::paginate($per_page));
    }

    public function store(CourseRequest $request)
    {
        return new CourseResource(Course::create($request->all()));
    }

    public function show($id)
    {
        //
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->all());
        return new CourseResource($course->fresh());
    }

    public function destroy($id)
    {
        //
    }
}
