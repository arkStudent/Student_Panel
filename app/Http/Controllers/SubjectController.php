<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\CalenderEvent; 
class SubjectController extends Controller

{
    public function showSelectSubjectForm()
    {
        $subjects = Subject::select('sub_id', 'sname')->distinct()->get();
        return view('select_subject', compact('subjects'));
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

        return view('subject_details', compact('fname', 'academic_year', 'std', 'dv', 'lessons'));
    }




    //calender Of Events
    public function showReports(Request $request)
    {
        // Retrieve session data for academic year and branch ID
        $academic_year = $request->session()->get('academic_year');
        $branch_id = $request->session()->get('branch_id');

        // Fetch branch name based on branch_id (assuming 'name' is the attribute)
        $branch = CalenderEvent::find($branch_id);
        $branch_name = $branch ? $branch->name : 'N/A';

        // Example: Fetch H.M name and Class Teacher name based on branch_id
        $hm =  "";
        $class_teacher =  "";

        // Fetch activities for the current academic year and branch_id
        $activities = CalenderEvent::where('academic_year', $academic_year)
                                   ->where('branch_id', $branch_id)
                                   ->get();

        // Prepare data to pass to the view
        $data = [
            'boxData' => [
                'branch_name' => $branch_name,
                'academic_year' => $academic_year,
                'hm' => $hm,
                'class_teacher' => $class_teacher,
            ],
            'activities' => $activities,
        ];

        // Return view with data
        return view('calenderOfEvent', $data);
    }
 
}


 