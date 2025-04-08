<?php

namespace App\Services\Course;

use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseService
{
    public function getFilteredCourses($filter, $perPage = 10)
    {
        return Course::query()
            ->filter($filter)
            ->paginate($perPage);
    }

    public function getLanguagesStats()
    {
        return Course::select('language', DB::raw('count(*) as count'))
            ->groupBy('language')
            ->get();
    }

    public function getLevelsStats()
    {
        return Course::select('level', DB::raw('count(*) as count'))
            ->groupBy('level')
            ->get();
    }

    public function getRatingsStats()
    {
        return Course::get()
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

    public function getDurationsStats()
    {
        return DB::table(function($query) {
                    $query->from('courses')
                        ->select('courses.id', DB::raw('FLOOR(SUM(lectures.duration) / 60) as duration_hours'))
                        ->join('lectures', 'courses.id', '=', 'lectures.course_id')
                        ->groupBy('courses.id');
                }, 'course_durations')
                ->select(
                    DB::raw('CASE
                        WHEN duration_hours < 5 THEN "< 5h"
                        WHEN duration_hours < 10 THEN "5h-10h"
                        WHEN duration_hours < 20 THEN "10h-20h"
                        WHEN duration_hours < 30 THEN "20h-30h"
                        WHEN duration_hours < 40 THEN "30h-40h"
                        WHEN duration_hours < 50 THEN "40h-50h"
                        ELSE ">50h"
                    END as duration'),
                    DB::raw('count(*) as count')
                )
                ->groupBy('duration')
                ->get();
    }

    public function getCostStats()
    {
        return Course::select(DB::raw('IF(price > 0, "Paid", "Free") as cost_type'), DB::raw('count(*) as count'))
            ->groupBy('cost_type')
            ->get();
    }
}
