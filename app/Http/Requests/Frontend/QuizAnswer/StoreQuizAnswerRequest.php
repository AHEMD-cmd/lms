<?php

namespace App\Http\Requests\Frontend\QuizAnswer;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizAnswerRequest extends FormRequest
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
            'option_ids' => 'required|array',
            'option_ids.*' => 'required|exists:question_options,id',
            'question_id' => 'required|exists:quiz_questions,id',
            'attempt_id' => 'required|exists:quiz_attempts,id',
        ];
    }
}
