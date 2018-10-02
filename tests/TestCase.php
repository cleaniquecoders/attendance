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
        $this->republish();
        $this->migrate();
        $this->seedReferenceData();
    }

    /**
     * Do clean up on tear down.
     */
    protected function tearDown()
    {
        $this->cleanUp();
        parent::tearDown();
    }

    public function loadFactories()
    {
        $this->withFactories(realpath(__DIR__ . '/../factories'));
    }

    /**
     * Clear all caches.
     */
    public function clearCaches()
    {
        $this->artisan('config:clear');
        $this->artisan('route:clear');
        $this->artisan('view:clear');
    }

    /**
     * Publish all package assets.
     */
    public function publish()
    {
        $this->artisan('vendor:publish', [
            '--provider' => \CleaniqueCoders\Attendance\AttendanceServiceProvider::class,
            '--force'    => true,
        ]);
    }

    /**
     * Republish assets.
     */
    public function republish()
    {
        $this->cleanUp();
        $this->clearCaches();
        $this->publish();
    }

    /**
     * Run all migrations.
     */
    public function migrate()
    {
        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->artisan('migrate', ['--database' => 'testbench']);
    }

    /**
     * Run seeder.
     */
    public function seedReferenceData()
    {
        $this->artisan('attendance:seed');
    }

    /**
     * Do test clean up.
     */
    public function cleanUp()
    {
        $this->removeMigrationFiles();
        $this->removeSeederFiles();
        $this->removeIfExist(config_path('attendance.php'));
    }

    /**
     * Remove all migration files if exist.
     */
    public function removeMigrationFiles()
    {
        collect(glob(database_path('migrations/*.php')))
            ->each(function ($path) {
                $this->removeIfExist($path);
            });
    }

    /**
     * Remove all seed files if exist.
     */
    public function removeSeederFiles()
    {
        collect(glob(database_path('seeds/*.php')))
            ->each(function ($path) {
                $this->removeIfExist($path);
            });
    }

    /**
     * Remove file if exists.
     *
     * @param string $path
     */
    public function removeIfExist($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Truncate table.
     */
    public function truncateTable($table)
    {
        \DB::table($table)->truncate();
    }

    /**
     * Seed single data.
     *
     * @param array  $datum
     * @param string $class Fully Qualified Class Name, FQCN
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function seedDatum($datum, $class)
    {
        return $class::create($datum);
    }

    /**
     * Seet multiple data at one time.
     *
     * @param array  $data  List of data
     * @param string $class Fully Qualified Class Name, FQCN
     */
    public function seedData($data, $class)
    {
        foreach ($data as $datum) {
            $this->seedDatum($datum, $class);
        }
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
            \CleaniqueCoders\LaravelObservers\LaravelObserversServiceProvider::class,
            \CleaniqueCoders\LaravelHelper\LaravelHelperServiceProvider::class,
            \CleaniqueCoders\Blueprint\Macro\BlueprintMacroServiceProvider::class,
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

    ////////////////////////////////////////////////////////
    ///////////////// Custom Assertions ////////////////////
    ////////////////////////////////////////////////////////

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
        $this->assertFileExists(config_path($config . '.php'));
    }

    /**
     * Assert has migration.
     *
     * @param string $migration migration name
     */
    protected function assertHasMigration($migration)
    {
        $this->assertHasClass($migration);
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
