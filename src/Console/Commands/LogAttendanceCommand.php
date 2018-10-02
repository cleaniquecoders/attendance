<?php

namespace CleaniqueCoders\Attendance\Console\Commands;

use Illuminate\Console\Command;

class LogAttendanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:log {identifier} {type} {field=id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log attendance time in or out';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = config('attendance.models.user')::query()
            ->where($this->argument('field'), $this->argument('identifier'))
            ->firstOrFail();
        $adapter = new \App\Adapters\ConsoleAdapter($user, now());

        if($this->argument('type') == \App\Models\AttendanceType::TIME_IN) {
            $adapter->timeIn();
        }

        if($this->argument('type') == \App\Models\AttendanceType::TIME_OUT) {
            $adapter->timeOut();
        }

        $this->info('Attendance Successfully logged.');
    }
}
