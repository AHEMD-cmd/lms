<?php

namespace App\Http\Requests\Instructor\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class StoreLectureRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:2000'],
            'url' => ['required', 'string', 'max:255'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'number' => $this->lastCourseLectureNumber() + 1,
        ]);
    }

    public function lastCourseLectureNumber()
    {
        return $this->route('course')->lectures->count() > 0 ? $this->route('course')->lectures()->latest()->first()->number : 0;
    }
}
