<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttendController extends Controller
{
    public function index()
    {
        return view('academic.attendance');
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
        $branch_id = $request->session()->get('branch_id');
        $from_date = $request->input('fdate');
        $to_date = $request->input('tdate');

        // Query the database
        // $attendance = DB::table('ark_atten')
        //     ->where('std', $std)
        //     ->where('dv', $dv)
        //     ->where('student_id', $student_id)
        //     ->whereBetween('date', [$request->fdate, $request->tdate])
        //     ->get();
        $query = DB::select("
                SELECT date,atn,id 
                FROM ark_atten 
                WHERE std = ? AND dv = ? AND student_id = ? AND date BETWEEN ? AND ? ORDER BY date",
                [$std, $dv, $student_id, $from_date, $to_date]);

        $query1 = DB::select("
                SELECT odate,day,id 
                FROM ark_dayoff 
                WHERE  branch_id = ? AND odate BETWEEN ? AND ? ORDER BY odate",
                [$branch_id, $from_date, $to_date]);

            $attendance = $query;
            $day_off = $query1;
            $combinedRecords = array_merge($attendance, $day_off);
            // return $query1;
            // return $combinedRecords;

            

        // Return the data to the attendTable view
        return view('attendTable', compact('combinedRecords', 'from_date', 'to_date'));
        // return view('attendTable', ['attendance' => $query,'day_off' => $query1]);
        // return view('attendTable', compact('attendance','request'));
    }
}
