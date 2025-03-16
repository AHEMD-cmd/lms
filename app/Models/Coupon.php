<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function isValid()
    {
        // return true;
        return $this->is_active
            && $this->start_date->isPast()
            && $this->end_date->isFuture()
            && ($this->times_used < $this->limit_number);
    }
}
