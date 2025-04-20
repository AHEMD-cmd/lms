<?php

namespace App\Http\Requests\Frontend\CourseCollection;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseCollectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'collection_id' => 'required|exists:collections,id',
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
