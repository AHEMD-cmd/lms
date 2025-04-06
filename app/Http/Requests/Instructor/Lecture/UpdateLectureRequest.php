<?php

namespace App\Http\Requests\Instructor\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLectureRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required_if:url,null', 'string', 'nullable', 'max:2000'],
            // 'url' => ['required_if:content,null', 'nullable',  'max:255', 'url'],
            'video_path' => ['required', 'string'],
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', 'file', 'max:5120'], // 5MB = 5120KB
            'duration' => ['required','integer','min:1'],
        ];
    }
}
