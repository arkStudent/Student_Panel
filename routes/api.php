<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendController;
use App\Http\Controllers\ArkController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeesController;

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
        Route::get('/select-subject','showSelectSubjectForm')->name('lessonPlan');
        Route::post('/subjects','getSubjectDetails')->name('get-subject-details');
        Route::get('/subjects/{sub_id}', 'showSubjectDetails')->name('subjects.show');
        Route::get('/reports','showReports')->name('calenderOfEvent');
      
    });

    // Routes handled by ExamController
    Route::controller(ExamController::class)->group(function () {
        Route::get('/examTTForm', 'index')->name('examTTForm');
        Route::post('/examTimeTable','submitTimeTable')->name('examTimeTable');
        Route::get('/select-exam','showSelectExamForm')->name('selectexam');
        Route::post('/exams','getExamDetails')->name('get-exam-details');
        Route::get('/exam/{branch_id}','showExamDetails')->name('exam.show');
 
    });

    // Routes handled by FeesController
    Route::controller(FeesController::class)->group(function () {
        Route::get('/fee_history', 'feeHistory')->name('feeHistory');
        Route::get('/fee_balance', 'feeBalance')->name('feeBalance');
    });

    // Logout route (outside of groups)
    Route::get('/logout', function (Request $request) {
        $request->session()->forget(['student_id', 'student_name']);
        $request->session()->flush();
        return redirect()->route('login');
    })->name('logout');
    
});