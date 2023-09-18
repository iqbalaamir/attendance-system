<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Let's add explicit records to demonstrate the "sandwich" logic
        Attendance::create([
            'emp_id' => 1,
            'date' => '2023-10-06',
            'day' => 'Friday',
            'status' => 'absent',
        ]);

        Attendance::create([
            'emp_id' => 1,
            'date' => '2023-10-07',
            'day' => 'Saturday',
            'status' => 'present',
        ]);

        Attendance::create([
            'emp_id' => 1,
            'date' => '2023-10-08',
            'day' => 'Sunday',
            'status' => 'present',
        ]);

        Attendance::create([
            'emp_id' => 1,
            'date' => '2023-10-09',
            'day' => 'Monday',
            'status' => 'absent',
        ]);

        // Continue with random entries
        foreach (range(1, 46) as $index) {  // Reduced to 46 to maintain total 50 records
            Attendance::create([
                'emp_id' => $faker->randomNumber(5),
                'date' => $faker->date,
                'day' => $faker->dayOfWeek,
                'status' => $faker->randomElement(['absent', 'present']),
            ]);
        }
    }
}
