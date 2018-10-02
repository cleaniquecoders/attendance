<?php

namespace CleaniqueCoders\Attendance\Console\Commands;

use Illuminate\Console\Command;

class SeedAttendanceTypesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Attendance Types';

    /**
     * Create a new command instance.
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
        $this->call('db:seed', [
            '--class' => 'AttendanceTypeSeeder',
        ]);

        $this->info('Attendance Types has been seeded.');
    }
}
