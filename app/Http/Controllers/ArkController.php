<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ArkController extends Controller
{

    public function index()
    {
        $std = session('std');
        $dv = session('dv');
        $branch_id = session('branch_id');
        // dd($branch_id);

        $academic_year = DB::table('ark_academic_year')->max('academic_year');

        // Query to fetch periods based on branch_id, academic_year, std, and dv
        $periodList = DB::select("
                    SELECT DISTINCT a.period, b.stime, b.etime
                    FROM ark_timetable a
                    LEFT JOIN ark_period b
                    ON b.branch_id = a.branch_id
                    AND b.academic_year = a.academic_year
                    AND b.standard = a.standard
                    AND b.period = a.period
                    WHERE a.branch_id = ?
                    AND a.academic_year = ?
                    AND a.standard = ?
                    AND a.dv = ?
                    ORDER BY a.period
                ", [$branch_id, $academic_year, $std, $dv]);


        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Prepare data for each day and period
        $timetableData = [];
        foreach ($days as $day) {
            $dayWisePeriods = [];
            foreach ($periodList as $pl) {
                $period = $pl->period;
                $dayWiseSubjects = DB::table('ark_timetable')
                    ->select(DB::raw('group_concat(sname) as sname'))
                    ->where('period', $period)
                    ->where('day', $day)
                    ->where('branch_id', $branch_id)
                    ->where('standard', $std)
                    ->where('dv', $dv)
                    ->where('academic_year', $academic_year)
                    ->first();

                $subjectNames = $dayWiseSubjects ? explode(",", $dayWiseSubjects->sname) : ['-'];
                $dayWisePeriods[] = [
                    'period' => $pl->period,
                    'stime' => $pl->stime,
                    'etime' => $pl->etime,
                    'subjects' => $subjectNames,
                ];
            }
            $timetableData[$day] = $dayWisePeriods;
        }
        return view('academic.timetable', compact('std', 'dv', 'timetableData', 'periodList', 'academic_year'));
    }

    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'student_id' => 'required',
            'password' => 'required'
        ]);

        if ($validatedData->fails()) {
            Log::error('Validation errors:', $validatedData->errors()->all());
            return response()->json($validatedData->errors(), 422);
        }

        $data = $validatedData->validated();

        $user = DB::table('ark_student_info')
            ->where('student_id', $data['student_id'])
            ->orWhere('sts_id', $data['student_id'])
            ->first();

        if ($user) {
            if ($data['password'] === $user->password) {
                session([
                    'student_id' => $user->student_id, 
                    'academic_year' => $user->academic_year,
                    'name' => $user->name, 
                    'branch_id' => $user->branch_id,
                    ]);

                $additionalData = DB::table('ark_students')
                    ->where('student_id', $data['student_id'])
                    ->first();

                session([
                    'std' => $additionalData ? $additionalData->class : null,
                    'dv' => $additionalData ? $additionalData->division : null
                ]);

                return response()->json(['message' => 'Logged in successfully', 'user' => $user], 201);
            } else {
                return response()->json(['error' => 'Incorrect password'], 422);
            }
        } else {
            return response()->json(['error' => 'User not found with provided id'], 422);
        }
    }

    // change password function
    public function changePass(Request $request)
    {
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required'
        ]);
        $student_id = Session::get('student_id');
        $user = DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->first();
        if ($request->old_pass !== $user->password) {
            return response()->json(['error' => 'Incorrect old password'], 400);
        }
        if ($request->old_pass === $request->new_pass) {
            return response()->json(['error' => 'Old and new passwords cannot be the same'], 400);
        }
        DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->update(['password' => $request->new_pass]);
        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    // forgot password function
    public function forgotPass(Request $request)
    {
        $request->validate([
            's_id' => 'required',
            'pass' => 'required',
            'cpass' => 'required'
        ]);
        $student_id = $request->s_id;
        // dd($student_id);

        $user = DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->first();
            if (!$user) {
                return response()->json(['error' => 'Incorrect student Id'], 400);
            } else if ($user->password === $request->pass) {
                return response()->json(['error' => 'Old password is same as new password'], 400);
            } else if ($request->pass !== $request->cpass) {
                return response()->json(['error' => 'Password and confirm password does not match'], 400);
            }
        DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->update(['password' => $request->pass]);
        return response()->json(['message' => 'Password set successfully'], 200);
    }
}
