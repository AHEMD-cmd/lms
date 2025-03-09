<?php

namespace App\Http\Requests\Instructor\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'required|string|max:255',
            'level' => 'required|string|max:255|in:Beginner,Middle,Advance',
            'duration' => 'required|string|max:255',
            'resources' => 'required|string',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'prerequisites' => 'required|string|max:2000',
            'bestseller' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'highest_rated' => 'nullable|boolean',
            'video' => 'nullable|file|mimes:mp4,webm|max:10240', // 10MB limit in KB       
            'has_certificate' => 'required|boolean',
            'course_goals' => 'required|array',
            'course_goals.*' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'course_goals.*.required' => 'Course goal is required',
            'course_goals.*.string' => 'Course goal must be a string',
            'course_goals.*.max:255' => 'Course goal must be less than 255 characters',
        ];
    }
}
