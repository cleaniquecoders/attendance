<?php

namespace CleaniqueCoders\Attendance\Traits;

trait AttendanceTrait
{
    public function attendances()
    {
        return $this->hasMany(config('attendance.models.attendance'));
    }
}
