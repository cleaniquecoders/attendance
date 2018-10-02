<?php

return [
    'timezone' => env('ATTENDANCE_TIMEZONE', 'Asia/Kuala_Lumpur'),
    'models'   => [
        'user'       => \App\User::class,
        'attendance' => \CleaniqueCoders\Attendance\Models\Attendance::class,
        'type'       => \CleaniqueCoders\Attendance\Models\AttendanceType::class,
    ],
    'drivers' => [
        'web'     => \CleaniqueCoders\Attendance\Adapters\WebAdapter::class,
        'api'     => \CleaniqueCoders\Attendance\Adapters\ApiAdapter::class,
        'console' => \CleaniqueCoders\Attendance\Adapters\ConsoleAdapter::class,
    ],
];
