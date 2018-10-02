<?php

use Illuminate\Database\Seeder;

class AttendanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	'Time In',
        	'Time Out',
        ];

        foreach ($data as $datum) {
        	config('attendance.models.type')::create([
        		'name' => $datum,
        		'label' => kebab_case($datum),
        	]);
        }
    }
}
