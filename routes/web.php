<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/attendance');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/attendance/mark-attendance', [AttendanceController::class,'markAttendance'])->name('mark.attendance');
    Route::get('/attendance/apply-leave', [AttendanceController::class,'applyLeave'])->name('apply.leave');
    Route::post('/attendance/mark-attendance', [AttendanceController::class,'storeAttendance'])->name('store.attendance');
    Route::post('/attendance/apply-leave', [AttendanceController::class,'storeLeave'])->name('store.leave');
});
