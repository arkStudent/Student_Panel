<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendController;
use App\Http\Controllers\ArkController;
use App\Http\Controllers\SubjectController;

// Route for user endpoint
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Group routes that require 'web' middleware
Route::middleware(['web'])->group(function () {

    // Routes handled by ArkController
    Route::controller(ArkController::class)->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::get('/timeTable', 'index')->name('timetable.index');
    });

    // Routes handled by AttendController
    Route::controller(AttendController::class)->group(function () {
        Route::get('/attendForm', 'index')->name('attend.index');
        Route::post('/attendTable','submitAttendance')->name('attend.table');
    });
     // Routes handled by SubjectController
     Route::controller(SubjectController::class)->group(function () {
        Route::get('/select-subject', [SubjectController::class, 'showSelectSubjectForm'])->name('selectsubject');
        Route::post('/subjects', [SubjectController::class, 'getSubjectDetails'])->name('get-subject-details');
        Route::get('/subjects/{sub_id}', [SubjectController::class, 'showSubjectDetails'])->name('subjects.show');

    //calender of event
        Route::get('/reports', [SubjectController::class, 'showReports'])->name('calenderOfEvent');
    });


    // Logout route (outside of groups)
    Route::get('/logout', function (Request $request) {
        $request->session()->forget(['student_id', 'student_name']);
        $request->session()->flush();
        return redirect()->route('login');
    })->name('logout');
    
});