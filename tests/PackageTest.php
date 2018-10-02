<?php 

namespace CleaniqueCoders\Attendance\Tests;

use CleaniqueCoders\Attendance\Tests\Traits\TestCaseTrait;

class PackageTest extends TestCase
{
	/** @test */
	public function it_has_config_file_published()
	{
		$this->assertFileExists(config_path('attendance.php'));
	}

	/** @test */
	public function it_has_migration_files_published()
	{
		$this->assertHasClass('CreateAttendancesTable');
		$this->assertHasClass('CreateAttendanceTypesTable');
	}

	/** @test */
	public function it_has_attendance_types_table()
	{
		$this->assertHasTable('attendance_types');
	}

	/** @test */
	public function it_has_attendance_types_time_in_data()
	{
		$this->assertDatabaseHas('attendance_types', ['name' => 'Time In']);
	}

	/** @test */
	public function it_has_attendance_types_time_out_data()
	{
		$this->assertDatabaseHas('attendance_types', ['name' => 'Time Out']);
	}

	/** @test */
	public function it_has_attendances_table()
	{
		$this->assertHasTable('attendances');
	}
}