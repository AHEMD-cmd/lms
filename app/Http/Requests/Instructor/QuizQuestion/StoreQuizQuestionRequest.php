<?php

namespace App\Http\Requests\Instructor\QuizQuestion;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ensure proper authorization in real use cases
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:1000'],
            'is_multiple' => ['nullable', 'boolean'],
            'options' => ['required', 'array', 'min:3', 'max:3'], // At least 2 options
            'options.*' => ['required', 'string', 'max:255'], // Each option must be a string
            'is_correct' => ['required', 'array', 'min:1', 'max:3'], // At least one correct answer
            'is_correct.*' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        $optionLabels = [
            'options.0' => 'First option',
            'options.1' => 'Second option',
            'options.2' => 'Third option',
        ];

        $messages = [];

        foreach ($optionLabels as $key => $label) {
            $messages["$key.required"] = "⚠ $label is required.";
            $messages["$key.string"] = "⚠ $label must be a valid text.";
            $messages["$key.max"] = "⚠ $label should not exceed :max characters.";
        }

        return $messages;
    }
}
