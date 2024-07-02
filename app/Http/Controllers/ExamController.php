<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ExamController extends Controller
{
    public function index(Request $request)
    {
        $branch_id = $request->session()->get('branch_id');
        $examTypes = DB::select("
            SELECT ename, id 
            FROM sal_exam_type 
            WHERE branch_id = '$branch_id'
        ");

        return view('examTTForm', compact('examTypes', 'request'));
    }

    public function submitTimeTable(Request $request)
    {
        // Validate the request data
        $request->validate([
            'exam_type' => 'required',
        ]);

        //Retrive Values
        $std = $request->session()->get('std');
        $branch_id = $request->session()->get('branch_id');
        $acd_year = $request->session()->get('academic_year');
        $examType = $request->input('exam_type');

        $examTimeDetails = DB::select("
                SELECT *
                FROM sal_exam_tt 
                WHERE std = ? AND ex_id = ? AND branch_id = ? AND academic_year = ? ",
                [$std, $examType, $branch_id, $acd_year]);


        return view('exam_time_table',compact('examTimeDetails','request'));

    }

}
