<?php

namespace CleaniqueCoders\Attendance;

use Illuminate\Support\ServiceProvider;

class AttendanceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Configuration
         */
        $this->publishes([
            __DIR__ . '/../config/attendance.php' => config_path('attendance.php'),
        ], 'attendance-config');

        /*
         * Database - Migrations, Factories and Seeders
         */
        if (! class_exists('CreateAttendancesTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_attendance_types_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_attendance_types_table.php'),
                __DIR__ . '/../database/migrations/create_attendances_table.stub'      => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_attendances_table.php'),
            ], 'attendance-database');
        }

        /*
         * Commands
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\InstallCommand::class,
                Console\Commands\LogAttendanceCommand::class,
                Console\Commands\MakeAttendanceAdapterCommand::class,
                Console\Commands\SeedAttendanceTypesCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
             __DIR__ . '/../config/attendance.php', 'attendance'
        );
    }
}
