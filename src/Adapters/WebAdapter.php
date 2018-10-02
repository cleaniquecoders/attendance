<?php 

namespace CleaniqueCoders\Attendance\Adapters;

class WebAdapter extends BaseAdapter
{
	protected $driver = 'web';

	public function timeIn()
	{
		$this->capture(AttendanceType::TIME_IN);
	}

	public function timeOut()
	{
		$this->capture(AttendanceType::TIME_OUT);
	}
}