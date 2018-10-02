<?php

namespace CleaniqueCoders\Attendance\Adapters;

class ConsoleAdapter extends BaseAdapter
{
    protected $driver = 'console';

    public function timeIn()
    {
        $this->capture(AttendanceType::TIME_IN);
    }

    public function timeOut()
    {
        $this->capture(AttendanceType::TIME_OUT);
    }
}
