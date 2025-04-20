<?php

namespace App\Filters\Frontend;

use App\Helpers\QueryFilter;
use Illuminate\Support\Facades\Auth;

class UserCoursesFilter extends QueryFilter
{
    /**
     * Filter by search term in course title
     *
     * @param string|null $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($search = null)
    {
        if (!empty($search)) {
            return $this->builder->where('title', 'like', "%$search%");
        }
        return $this->builder;
    }

    /**
     * Sort courses by selected criteria
     *
     * @param string|null $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort($sort = null)
    {
        if (!empty($sort)) {
            switch ($sort) {
                case '0': // Recently Accessed
                    return $this->builder->orderBy('course_users.updated_at', 'desc');
                case '1': // Recently Enrolled
                    return $this->builder->orderBy('course_users.created_at', 'desc');
                case '2': // Title: A-to-Z
                    return $this->builder->orderBy('title', 'asc');
                case '3': // Title: Z-to-A
                    return $this->builder->orderBy('title', 'desc');
                case '4': // Completion: 0% to 100%
                    return $this->builder->orderByRaw('(
                        SELECT COUNT(*) FROM lecture_progress 
                        WHERE lecture_progress.user_id = ? AND lecture_progress.course_id = courses.id AND is_completed = 1
                    ) / NULLIF((
                        SELECT COUNT(*) FROM lectures WHERE lectures.course_id = courses.id
                    ), 0) ASC', [Auth::id()]);
                case '5': // Completion: 100% to 0%
                    return $this->builder->orderByRaw('(
                        SELECT COUNT(*) FROM lecture_progress 
                        WHERE lecture_progress.user_id = ? AND lecture_progress.course_id = courses.id AND is_completed = 1
                    ) / NULLIF((
                        SELECT COUNT(*) FROM lectures WHERE lectures.course_id = courses.id
                    ), 0) DESC', [Auth::id()]);
            }
        }
        return $this->builder;
    }

    /**
     * Filter by category, favorites, or archived
     *
     * @ param string|null $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function category($category = null)
    {
        if (!empty($category) && $category !== 'all') {
            if ($category === 'favorites') {
                // Favorites: filter courses where course_users.is_favorite = true
                return $this->builder->where('course_users.is_favorite', true);
            } elseif ($category === 'archived') {
                // Archived: filter courses where course_users.is_archived = true
                return $this->builder->where('course_users.is_archived', true);
            } else {
                // Specific category ID
                return $this->builder->where('category_id', $category);
            }
        }
        return $this->builder;
    }

    /**
     * Filter by instructor
     *
     * @param string|null $instructor
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function instructor($instructor = null)
    {
        if (!empty($instructor) && $instructor !== 'all') {
            return $this->builder->where('instructor_id', $instructor);
        }
        return $this->builder;
    }
}
