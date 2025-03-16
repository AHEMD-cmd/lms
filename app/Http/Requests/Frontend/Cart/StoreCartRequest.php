<?php

namespace App\Http\Requests\Frontend\Cart;

use App\Models\Course;
use App\Services\Cart\CartService;
use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        $course = Course::findOrFail($validated['course_id']);
        return array_merge($validated, [
            'session_id' => CartService::getCartId(),
            'price' => $course->price,
            'discounted_price' => $course->discount ? $course->discount : $course->price,
        ]);
    }
}
