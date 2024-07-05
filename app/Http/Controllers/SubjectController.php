<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; 
use App\Models\CalenderEvent;
use App\Models\Exam;
use App\Models\ExamDetails; 
use Illuminate\Support\Facades\DB;
class SubjectController extends Controller

{
    // //lesson plan
    // public function showSelectSubjectForm()
    // {
    //     $subjects = Subject::select('sub_id', 'sname')->distinct()->get();
    //     return view('academic.lessonPlan', compact('subjects'));
    // }

    // public function getSubjectDetails(Request $request)
    // {
    //     $sub_id = $request->input('subject');
    //     $subject = Subject::where('sub_id', $sub_id)->first();

    //     if (!$subject) {
    //         return response()->json(['error' => 'Subject not found'], 404);
    //     }

    //     $lessons = Subject::where('fname', $subject->fname)
    //                     ->where('std', $subject->std)
    //                     ->where('dv', $subject->dv)
    //                     ->where('academic_year', $subject->academic_year)
    //                     ->get();

    //     return response()->json([
    //         'sub_id' => $subject->sub_id,
    //         'fname' => $subject->fname,
    //         'academic_year' => $subject->academic_year,
    //         'std' => $subject->std,
    //         'dv' => $subject->dv,
    //         'lessons' => $lessons
    //     ]);
    // }

    // public function showSubjectDetails($sub_id)
    // {
    //     $subject = Subject::where('sub_id', $sub_id)->first();

    //     if (!$subject) {
    //         abort(404, 'Subject not found');
    //     }

    //     $fname = $subject->fname;
    //     $academic_year = $subject->academic_year;
    //     $std = $subject->std;
    //     $dv = $subject->dv;

    //     $lessons = Subject::where('fname', $fname)
    //                     ->where('std', $std)
    //                     ->where('dv', $dv)
    //                     ->where('academic_year', $academic_year)
    //                     ->get();

    //     return view('academic.lessonPlanRepo', compact('fname', 'academic_year', 'std', 'dv', 'lessons'));
    // }


    //lesson plan
    public function showSelectSubjectForm()
    {
        $subjects = Subject::select('sub_id', 'sname')->distinct()->get();
        return view('academic.lessonPlan', compact('subjects'));
    }

    public function getSubjectDetails(Request $request)
    {
        $sub_id = $request->input('subject');
        $subject = Subject::where('sub_id', $sub_id)->first();

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        $lessons = Subject::where('fname', $subject->fname)
                        ->where('std', $subject->std)
                        ->where('dv', $subject->dv)
                        ->where('academic_year', $subject->academic_year)
                        ->get();

        return response()->json([
            'sub_id' => $subject->sub_id,
            'fname' => $subject->fname,
            'academic_year' => $subject->academic_year,
            'std' => $subject->std,
            'dv' => $subject->dv,
            'lessons' => $lessons
        ]);
    }

    public function showSubjectDetails($sub_id)
    {
        $subject = Subject::where('sub_id', $sub_id)->first();

        if (!$subject) {
            abort(404, 'Subject not found');
        }

        $fname = $subject->fname;
        $academic_year = $subject->academic_year;
        $std = $subject->std;
        $dv = $subject->dv;

        $lessons = Subject::where('fname', $fname)
                        ->where('std', $std)
                        ->where('dv', $dv)
                        ->where('academic_year', $academic_year)
                        ->get();

        return view('academic.lessonPlanRepo', compact('fname', 'academic_year', 'std', 'dv', 'lessons'));
    }

    //calender Of Events table
    public function showReports(Request $request)
{
    $academic_year = $request->session()->get('academic_year');
    $branch_id = $request->session()->get('branch_id');

    $branch_name = DB::table('ark_branches')
                    ->where('id', $branch_id)
                    ->value('sname'); 
    $hm = '';  
    $class_teacher = '';   
    $activities = CalenderEvent::where('academic_year', $academic_year)
                                ->where('branch_id', $branch_id)
                                ->get(); 
    
    $data = [
        'branch' => (object) ['id' => $branch_id, 'sname' => $branch_name],
        'academic_year' => $academic_year,
        'hm' => $hm,
        'class_teacher' => $class_teacher,
        'activities' => $activities,
    ];
    
    return view('academic.calenderOfEvent', $data);
}

    public function showSelectExamForm(Request $request)
    {
        $academic_year = $request->session()->get('academic_year');
        $branch_id = $request->session()->get('branch_id');
        
        $std = $request->session()->get('std');
        $dv = $request->session()->get('dv'); 
        $branch = DB::table('ark_branches')
                    ->where('id', $branch_id)
                    ->select('id', 'sname')  
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


 