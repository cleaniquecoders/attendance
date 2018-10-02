<?php

namespace CleaniqueCoders\Attendance\Adapters;

class ApiAdapter extends BaseAdapter
{
    protected $driver = 'api';

    public function timeIn()
    {
        $this->capture(AttendanceType::TIME_IN);
    }

    public function timeOut()
    {
        $this->capture(AttendanceType::TIME_OUT);
    }
}
