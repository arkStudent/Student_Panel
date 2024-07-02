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
        // Validate the requested data
        $request->validate([
            'fdate' => 'required|date',
            'tdate' => 'required|date|after_or_equal:fdate',
        ]);

        // Retrieve values 
        $std = $request->session()->get('std');
        $dv = $request->session()->get('dv');
        $student_id = $request->session()->get('student_id');
        $branch_id = $request->session()->get('branch_id');
        $from_date = $request->input('fdate');
        $to_date = $request->input('tdate');

        //Query for Attendance
        $attendance = DB::select("
                    SELECT a.*, d.odate,d.day,d.remarks
                    FROM ark_atten a LEFT JOIN ark_dayoff d
                    ON 
                        a.branch_id = d.branch_id 
                        AND a.date = d.odate
                    WHERE 
                        a.std = ? AND a.dv = ? AND a.student_id = ? AND a.date BETWEEN ? AND ?
                    UNION
                    SELECT 
                        NULL AS id, NULL AS class_id, NULL AS student_id, d.branch_id, NULL AS subject_id, NULL AS fid, 
                        NULL AS std, NULL AS dv, NULL AS period, NULL AS from_time, NULL AS to_time, d.odate AS date, 
                        NULL AS atn, NULL AS academic_year, NULL AS created_at, NULL AS updated_at,d.odate,d.day,d.remarks
                    FROM 
                        ark_dayoff d
                    WHERE 
                        d.branch_id = ? AND d.odate BETWEEN ? AND ?
                    ORDER BY date", [$std, $dv, $student_id, $from_date, $to_date, $branch_id, $from_date, $to_date]);
            // return $attendance;

        // Return the data to the attendTable view
        return view('academic.attendTable', compact('attendance','request'));
    }
}
