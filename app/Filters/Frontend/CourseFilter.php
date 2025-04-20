<?php

namespace App\Filters\Frontend;

use App\Helpers\QueryFilter;

class CourseFilter extends QueryFilter {
    public function search($search = null)
    {
        if (!empty($search)) {
            return $this->builder->where('title', 'like', "%$search%");
        }   
        return $this->builder;
    }
    
    public function rating($rating = null)
    {
        if (!empty($rating)) {
            return $this->builder->whereHas('reviews', function ($query) use ($rating) {
                $query->where('status', 1);
            })->whereRaw('(SELECT AVG(rate) FROM reviews WHERE reviews.course_id = courses.id AND reviews.status = 1) >= ?', [$rating]);
        }
        return $this->builder;
    }
    
    public function language($languages = [])
    {
        if (!empty($languages)) {
            return $this->builder->whereIn('language', $languages);
        }
        return $this->builder;
    }
    
    public function level($levels = [])
    {
        if (!empty($levels)) {
            if (in_array('all', $levels)) {
                if (count($levels) === 1) {
                    // No filter applied, include all levels
                    return $this->builder;
                } else {
                    // Exclude "all" and apply the rest
                    $levels = array_diff($levels, ['all']);
                    return $this->builder->whereIn('level', $levels);
                }
            } else {
                return $this->builder->whereIn('level', $levels);
            }
        }
        return $this->builder;
    }
    
    public function cost($cost = null)
    {
        if (!empty($cost)) {
            if ($cost === 'paid') {
                return $this->builder->where('price', '>', 0);
            } elseif ($cost === 'free') {
                return $this->builder->where(function ($query) {
                    $query->where('price', 0)->orWhereNull('price');
                });
            }
        }
        return $this->builder;
    }
    
    public function duration($durations = [])
    {
        if (!empty($durations)) {
            return $this->builder->where(function ($query) use ($durations) {
                foreach ($durations as $duration) {
                    switch ($duration) {
                        case '0-2':
                            $query->orWhereHas('lectures', function ($q) {
                                $q->havingRaw('FLOOR(SUM(duration) / 60) BETWEEN 0 AND 2')
                                  ->groupBy('course_id');
                            });
                            break;
                        case '3-6':
                            $query->orWhereHas('lectures', function ($q) {
                                $q->havingRaw('FLOOR(SUM(duration) / 60) BETWEEN 3 AND 6')
                                  ->groupBy('course_id');
                            });
                            break;
                        case '7-14':
                            $query->orWhereHas('lectures', function ($q) {
                                $q->havingRaw('FLOOR(SUM(duration) / 60) BETWEEN 7 AND 14')
                                  ->groupBy('course_id');
                            });
                            break;
                        case '16+':
                            $query->orWhereHas('lectures', function ($q) {
                                $q->havingRaw('FLOOR(SUM(duration) / 60) >= 16')
                                  ->groupBy('course_id');
                            });
                            break;
                    }
                }
            });
        }
        return $this->builder;
    }
}