<?php
// sana code

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; 
use App\Models\CalenderEvent; 
use Illuminate\Support\Facades\DB;
class SubjectController extends Controller

{
     
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
                    ->value('name'); 
    $hm = '';  
    $class_teacher = '';   
    $activities = CalenderEvent::where('academic_year', $academic_year)
                                ->where('branch_id', $branch_id)
                                ->get(); 
    
    $data = [
        'branch' => (object) ['id' => $branch_id, 'name' => $branch_name],
        'academic_year' => $academic_year,
        'hm' => $hm,
        'class_teacher' => $class_teacher,
        'activities' => $activities,
    ];
    
    return view('academic.calenderOfEvent', $data);
}
 
}


 