<?php

namespace App\Http\Requests\Instructor\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'code' => ['required', 'string', 'unique:coupons,code,' . $this->route('coupon')->id, 'max:100', ],
            'type' => ['required', 'string', 'in:platform,instructor,course'],
            'auto_applied' => ['nullable', 'boolean'],
            'instructor_id' => ['required_if:type,instructor', 'nullable', 'exists:users,id,role,instructor'],
            'course_id' => ['required_if:type,course', 'nullable', 'exists:courses,id'],
            'discount_percentage' => ['required', 'integer', 'min:0', 'max:100', 'in:100,90,50'],
            'start_date' => ['required', 'date', 'after_or_equal:' . $this->route('coupon')->start_date->format('Y-m-d H:i')],
            'end_date' => ['required', 'date', 'after:start_date'],
            'limit_number' => ['required', 'integer', 'min:1', 'max:1000'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'auto_applied' => $this->auto_applied ?? 0,
        ]);
    }
}
