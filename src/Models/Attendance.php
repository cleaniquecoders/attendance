<?php

namespace CleaniqueCoders\Attendance\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(config('attendance.models.user'));
    }

    public function type()
    {
        return $this->belongsTo(config('attendance.models.type'))->withDefault();
    }

    public function scopeTodayEntries($query, $driver = null)
    {
        if (! is_null($driver)) {
            if (is_string($driver)) {
                $query->whereDriver($driver);
            }

            if (is_array($driver)) {
                $query->whereIn('driver', $driver);
            }
        }

        return $query->whereDate('created_at', now()->format('Y-m-d'));
    }
}
