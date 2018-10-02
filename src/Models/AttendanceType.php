<?php

namespace CleaniqueCoders\Attendance\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceType extends Model
{
	const TIME_IN = 1;
    const TIME_OUT = 2;
    
    protected $guarded = ['id'];
}
