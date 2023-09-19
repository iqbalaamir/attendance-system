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
                'user_id' => $emp_id,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'status' => 'pending',
                'reason' => $request->input('reason')
            ]);
            Attendance::create([
                'emp_id' => $emp_id,
                'date' => $date->toDateString(),
                'day' => $date->format('l'),
                'status' => 'absent'
            ]);
        }
    
        return redirect()->back()->with('success', 'Leave applied successfully, and sandwich logic reapplied.');
    }
    
}
