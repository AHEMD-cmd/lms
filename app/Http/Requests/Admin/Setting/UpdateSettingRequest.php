<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'phone' => 'string|max:20|nullable',
            'email' => 'email|max:255|nullable',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'address' => 'string|max:500|nullable',
            'footer_logo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'facebook' => 'string|nullable|url',
            'twitter' => 'string|nullable|url',
            'instagram' => 'string|nullable|url',
            'linkedin' => 'string|nullable|url',
            'about_us_title' => 'string|max:255|nullable',
            'about_us_description' => 'string|nullable',
        ];
    }
}