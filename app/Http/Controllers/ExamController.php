<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ExamDetails; 
use App\Models\Exam;
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

        return view('exam.examTTForm', compact('examTypes', 'request'));
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
                        ->select('sname')
                        ->where('id', $branch_id)
                        ->first();
                // dd($branch_name);

        $examTimeDetails = DB::select("
                SELECT *
                FROM sal_exam_tt 
                WHERE std = '$std' AND ex_id = '$examType' AND branch_id = '$branch_id' AND academic_year = '$acd_year' 
                ORDER BY `date`");

        // dd($examTimeDetails);

        return view('exam.exam_time_table',compact('examTimeDetails','branch_name'));

    }


    //Sana : Exams
    public function showSelectExamForm(Request $request)
    {
        $academic_year = $request->session()->get('academic_year');
        $branch_id = $request->session()->get('branch_id');
        
        $std = $request->session()->get('std');
        $dv = $request->session()->get('dv'); 
        $branch = DB::table('ark_branches')
                    ->where('id', $branch_id)
                    ->select('id', 'name')  
                    ->first();
                    //dd($branch);
        $exam = Exam::select('branch_id', 'ename')->distinct()->get(); 
        return view('Exams.exam_wise_result', compact('exam', 'branch'));
    }
    
    //Exam Details Table
    public function getExamDetails(Request $request)
{
    $branch_id = $request->input('exam');  
 
    $examMarks = ExamDetails::where('ex_id', $branch_id)
                            ->where('academic_year', session('academic_year'))
                            ->get();

    return response()->json(['branch_id' => $branch_id, 'examMarks' => $examMarks]);
}
  
public function showExamDetails($branch_id)
{ 
    $subject = ExamDetails::where('branch_id', $branch_id)->first();

    if (!$subject) { 
        $student_id = '';
        $sname = '';
        $academic_year = '';
        $std = '';
        $dv = '';
        $examMarks = [];
 
        return view('Exams.exam_details', compact('student_id', 'sname', 'academic_year', 'std', 'dv', 'examMarks'));
    }

    // If subject found, retrieve necessary data
    $student_id = $subject->student_id;
    $sname = $subject->sname;
    $academic_year = $subject->academic_year;
    $std = $subject->std;
    $dv = $subject->dv;

    // Fetch exam marks based on subject details
    $examMarks = ExamDetails::where('student_id', $student_id)
                    ->where('sname', $sname)
                    ->where('std', $std)
                    ->where('dv', $dv)
                    ->where('academic_year', $academic_year)
                    ->get();

    // Return view with retrieved data
    return view('Exams.exam_details', compact('student_id', 'sname', 'academic_year', 'std', 'dv', 'examMarks'));
}

}
