<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var Course $course */
        $course = $this->course;

        if($course->exists && $course->trainer_id != Auth::id()){
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json(
            ['errors' => 'no authorization'],
            JsonResponse::HTTP_FORBIDDEN
        ));
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ['errors' => $validator->errors()],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
