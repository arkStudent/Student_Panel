<?php
// lubna code 

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

        return view('exams.examTTForm', compact('examTypes', 'request'));
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

        $branch_name = DB::table('ark_branches')
                        ->select('name')
                        ->where('id', $branch_id)
                        ->first();
                // dd($branch_name);

        $examTimeDetails = DB::select("
                SELECT *
                FROM sal_exam_tt 
                WHERE std = '$std' AND ex_id = '$examType' AND branch_id = '$branch_id' AND academic_year = '$acd_year' 
                ORDER BY `date`");

        // dd($examTimeDetails);

        return view('exams.exam_time_table',compact('examTimeDetails','branch_name'));

    }

}
