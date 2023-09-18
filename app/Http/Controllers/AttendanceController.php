<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        $attendances = Attendance::applySandwichLogic($attendances);
        return view('attendance.index', ['attendances' => $attendances]);
    }
}
