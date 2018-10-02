<?php

namespace CleaniqueCoders\Attendance\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Attendance';

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
        if ('testing' != app()->environment()) {
            $route = file_get_contents(__DIR__ . '/stubs/routes/api.stub');
            $file  = base_path('routes/api.php');
            file_put_contents($file, $route, FILE_APPEND | LOCK_EX);
        }

        $this->call('vendor:publish', [
            '--provider' => 'CleaniqueCoders\Attendance\AttendanceServiceProvider',
            '--force'    => true,
        ]);

        $this->call('attendance:seed');

        $this->line(' ');
        $this->info('Attendance has been sucessfully installed! Thanks for using Attendance!');
    }
}
