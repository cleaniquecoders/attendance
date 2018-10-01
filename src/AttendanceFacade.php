<?php

namespace CleaniqueCoders\Attendance;

/*
 * This file is part of attendance
 *
 * @license MIT
 * @package attendance
 */

use Illuminate\Support\Facades\Facade;

class AttendanceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Attendance';
    }
}
