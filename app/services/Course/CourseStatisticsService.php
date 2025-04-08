<?php

namespace App\Services\Course;

use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CourseStatisticsService
{
    /**
     * Get language statistics.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Support\Collection
     */
    public function getLanguagesStats($query)
    {
        return (clone $query)
            ->select('language', DB::raw('count(*) as count'))
            ->groupBy('language')
            ->get();
    }

    /**
     * Get level statistics.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Support\Collection
     */
    public function getLevelsStats($query)
    {
        return (clone $query)
            ->select('level', DB::raw('count(*) as count'))
            ->groupBy('level')
            ->get();
    }

    /**
     * Get ratings statistics.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return array
     */
    public function getRatingsStats($query)
    {
        return $query->get()
            ->filter(function ($course) {
                return $course->averageRating() > 0;
            })
            ->groupBy(function ($course) {
                $avg = $course->averageRating();
                return number_format(floor($avg), 1);
            })
            ->mapWithKeys(function ($group, $key) {
                return [$key => count($group)];
            })
            ->all();
    }

    /**
     * Get cost statistics.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Support\Collection
     */
    public function getCostStats($query)
    {
        return (clone $query)
            ->select(
                DB::raw('IF(price > 0, "Paid", "Free") as cost_type'),
                DB::raw('count(*) as count')
            )
            ->groupBy('cost_type')
            ->get();
    }
}
