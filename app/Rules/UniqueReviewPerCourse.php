<?php

namespace App\Rules;

use App\Models\Review;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class UniqueReviewPerCourse implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existingReview = Review::where('user_id', Auth::id())
            ->where('course_id', $value)
            ->exists();

        if ($existingReview) {
            $fail('You have already submitted a review for this course.');
        }
    }
}