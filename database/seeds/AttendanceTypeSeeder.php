<?php

use Illuminate\Database\Seeder;

class AttendanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            'Time In',
            'Time Out',
        ];

        foreach ($data as $datum) {
            \CleaniqueCoders\Attendance\Models\AttendanceType::create([
                'name'  => $datum,
                'label' => kebab_case($datum),
            ]);
        }
    }
}
