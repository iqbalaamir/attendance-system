<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Leave;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->get();
        $processedAttendances = Attendance::applySandwichLogic($attendances);
        return view('attendance.index', ['attendances' =>  $processedAttendances]);
    }

    public function markAttendance()
    {
        return view('attendance.mark-attendance');
    }

    public function applyLeave()
    {
        return view('attendance.apply-leave');
    }

    public function storeAttendance(Request $request)
    {
        $date = Carbon::now()->toDateString();

        $status = 'present';

        $emp_id = auth()->user()->id;

        Attendance::create([
            'emp_id' => $emp_id,
            'date' => $date,
            'day' => Carbon::now()->dayName,
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Attendance marked successfully.');
    }

    public function storeLeave(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
    
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
    
        $emp_id = auth()->user()->id;
    
        // Apply leaves
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            Leave::create([
                'emp_id' => $emp_id,
                'date' => $date->toDateString(),
                'status' => 'pending'
            ]);
        }
    
        // Reapply sandwich logic here to update all attendance records
        $attendanceRecords = Attendance::where('emp_id', $emp_id)->orderBy('date', 'asc')->get();
        $newRecords = Attendance::applySandwichLogic($attendanceRecords);  
        
        // Update the attendance records in the database
        foreach($newRecords as $newRecord) {
            $attendance = Attendance::where('emp_id', $emp_id)
                                    ->where('date', $newRecord->date)
                                    ->first();
            if($attendance) {
                $attendance->status = $newRecord->status; 
                $attendance->sandwichAffected = $newRecord->sandwichAffected; 
                $attendance->save();
            }
        }
    
        return redirect()->back()->with('success', 'Leave applied successfully, and sandwich logic reapplied.');
    }
    
}
