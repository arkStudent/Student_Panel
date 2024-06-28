<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttendController extends Controller
{
    public function index()
    {
        return view('attendance');
    }

    public function submitAttendance(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fdate' => 'required|date',
            'tdate' => 'required|date|after_or_equal:fdate',
        ]);

        // Retrieve additional values from the session
        $std = $request->session()->get('std');
        $dv = $request->session()->get('dv');
        $student_id = $request->session()->get('student_id');

        // Query the database
        $attendance = DB::table('ark_attend')
            ->where('std', $std)
            ->where('dv', $dv)
            ->where('student_id', $student_id)
            ->whereBetween('date', [$request->fdate, $request->tdate])
            ->get();

        // Return the data to the attendTable view
        return view('attendTable', compact('attendance','request'));
    }
}
