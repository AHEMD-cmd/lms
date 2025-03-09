<?php

namespace App\Http\Requests\Frontend\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,role,instructor', // check if email is unique for just users with role=instructor
            'password' => 'required|string|min:8|max:255', 
            'address' => 'required|string', 
            'phone' => 'required|string|max:255|unique:users,phone',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'status' => 0,
            'role' => 'instructor',
        ]);
    }
}
