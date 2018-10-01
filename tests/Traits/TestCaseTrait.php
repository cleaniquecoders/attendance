<?php

namespace CleaniqueCoders\Attendance\Tests\Traits;

use Illuminate\Support\Facades\Schema;

trait TestCaseTrait
{
    use SeedTrait;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        // $this->loadFactories();
        // $this->cleanUp();
        // $this->publish();
        // $this->clearCaches();
        // $this->migrate();
    }

    /**
     * Do clean up on tear down.
     */
    protected function tearDown()
    {
        // $this->cleanUp();
        parent::tearDown();
    }

    public function loadFactories()
    {
        $this->withFactories(realpath(__DIR__ . '/../factories'));
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
     * Do test clean up.
     */
    public function cleanUp()
    {
        $this->removeMigrationFiles();
        $this->removeSeederFiles();
        // $this->removeIfExist(config_path('config.php'));
    }

    /**
     * Clear all caches.
     */
    public function clearCaches()
    {
        $this->artisan('config:clear');
    }

    /**
     * Republish assets.
     */
    public function republish()
    {
        $this->cleanUp();
        $this->clearCaches();
        $this->publish();
        $this->clearCaches();
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
     * Publish all package assets.
     */
    public function publish()
    {
        // $this->artisan('vendor:publish', [
        //     '--force' => true,
        //     '--tag'   => 'config',
        // ]);
    }

    /**
     * Truncate table.
     */
    public function truncateTable($table)
    {
        \DB::table($table)->truncate();
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
