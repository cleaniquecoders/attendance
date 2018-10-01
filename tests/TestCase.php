<?php

namespace CleaniqueCoders\Attendance\Tests;

use Illuminate\Support\Facades\Schema;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        // $this->loadLaravelMigrations(['--database' => 'testbench']);

        // $this->artisan('migrate', ['--database' => 'testbench']);
    }

    protected function tearDown()
    {
        collect(glob(database_path('migrations/*.php')))
            ->each(function ($path) {
                unlink($path);
            });
        parent::tearDown();
    }

    /**
     * Load Package Service Provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array List of Service Provider
     */
    protected function getPackageProviders($app)
    {
        return [
            \CleaniqueCoders\Attendance\AttendanceServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Assert the current database has table.
     *
     * @param string $table table name
     */
    protected function assertHasTable($table)
    {
        $this->assertTrue(Schema::hasTable($table));
    }

    /**
     * Assert the table has columns defined.
     *
     * @param string $table   table name
     * @param array  $columns list of columns
     */
    protected function assertTableHasColumns($table, $columns)
    {
        collect($columns)->each(function ($column) use ($table) {
            $this->assertTrue(Schema::hasColumn($table, $column));
        });
    }

    /**
     * Assert has helper.
     *
     * @param string $helper helper name
     */
    protected function assertHasHelper($helper)
    {
        $this->assertTrue(function_exists($helper));
    }

    /**
     * Assert has config.
     *
     * @param string $config config name
     */
    protected function assertHasConfig($config)
    {
        $this->assertFileExists(config_path($config));
    }

    /**
     * Assert has class.
     *
     * @param string $class class name
     */
    protected function assertHasClass($class)
    {
        $this->assertTrue(class_exists($class));
    }

    /**
     * Assert has class method exist.
     *
     * @param string $object object
     * @param string $method method
     */
    protected function assertHasClassMethod($object, $method)
    {
        $this->assertTrue(method_exists($object, $method));
    }
}
