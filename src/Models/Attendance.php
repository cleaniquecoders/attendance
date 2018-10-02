<?php

namespace CleaniqueCoders\Attendance\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(config('attendance.models.type'))->withDefault();
    }
}
