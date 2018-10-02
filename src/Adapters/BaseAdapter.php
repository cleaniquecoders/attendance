<?php 

namespace CleaniqueCoders\Attendance\Adapters;

use App\Models\AttendanceType;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\User;

abstract class BaseAdapter
{
	abstract public function timeIn();
	abstract public function timeOut();

	public function __construct(User $user, Carbon $time)
	{
		$this->user = $user;
		$this->time = $time;
	}

	public function driver()
	{
		return $this->driver;
	}

	public function user()
	{
		return $this->user;
	}

	public function time()
	{
		return $this->time;
	}

	public function capture(int $type, string $identifier = null, $data = null)
	{
		config('attendance.models.attendance')::create([
			'user_id' => $this->user()->id,
			'identifier' => $identifier,
			'data' => $data,
			'attendance_type_id' => $type,
			'driver' => $this->driver(),
			'created_at' => $this->time(),
		]);
	}
}