<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['emp_id', 'date', 'day', 'status'];
    protected $table = 'attendance';

    public static function applySandwichLogic(Collection $attendanceRecords)
    {
        $employeeData = [];

        $newRecords = $attendanceRecords->map(function ($record) use (&$employeeData) {
            $emp_id = $record->emp_id;
            $date = $record->date;
            $day = $record->day;
            $status = $record->status; 

            $employeeData[$emp_id] = $employeeData[$emp_id] ?? [
                'consecutiveDaysAbsent' => 0,
                'sandwichDays' => []
            ];

            $employeeData[$emp_id]['consecutiveDaysAbsent'] = $status === 'absent'
                ? $employeeData[$emp_id]['consecutiveDaysAbsent'] + 1
                : 0;

            if ($day === 'Monday' && $employeeData[$emp_id]['consecutiveDaysAbsent'] >= 4) {
                $employeeData[$emp_id]['sandwichDays'][] = $date;
            }

            if ($employeeData[$emp_id]['consecutiveDaysAbsent'] > 10) {
                $employeeData[$emp_id]['sandwichDays'] = [];
            }

            $record->sandwichAffected = in_array($date, $employeeData[$emp_id]['sandwichDays']);
            return $record;
        });

        return $newRecords;
    }
}
