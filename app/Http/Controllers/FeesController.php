<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesController extends Controller
{
    // function to fetch fees details
    public function feeHistory()
    {
        $academic_year = DB::table('ark_academic_year')->max('academic_year');
        $stud_id = session('student_id');
        $std = session('std');
        $branch_id = session('branch_id');
        $category = DB::table('sal_fees_trans')
            ->select('category')
            ->distinct()
            ->where('student_id', $stud_id)
            ->pluck('category');

            $query = "SELECT
            a.bhead_id,
            b.head,
            b.amount AS total_amount,
            a.amount AS paid_amount,
            b.amount - COALESCE((SELECT SUM(at.amount) FROM sal_fees_trans at WHERE b.head_id = at.bhead_id AND at.student_id = '$stud_id' AND at.academic_year = '$academic_year'), 0) AS balance_amount,
            a.pdate
        FROM
            sal_fees_trans a
        JOIN
            sal_fees_bhead b ON b.head_id = a.bhead_id
        WHERE
            a.student_id = '$stud_id'
            AND b.branch_id = '$branch_id'
            AND b.std = '$std'
            AND b.academic_year = '$academic_year'
        ORDER BY
            a.pdate ASC";

        $feeHistory = DB::select($query);

        return view('fees.feesHistory', compact('academic_year', 'feeHistory', 'category'));
    }

    // function to fetch balance fees
    public function feeBalance()
    {
        $academic_year = DB::table('ark_academic_year')->max('academic_year');
        $stud_id = session('student_id');
        $std = session('std');
        $branch_id = session('branch_id');
        $category = DB::table('sal_fees_trans')
            ->select('category')
            ->distinct()
            ->where('student_id', $stud_id)
            ->pluck('category');

        $query = "SELECT
        b.head,
        b.amount AS total_amount,
        COALESCE(SUM(a.amount), 0) AS paid_amount,
        b.amount - COALESCE(SUM(a.amount), 0) AS balance_amount
        FROM
            sal_fees_bhead b
        LEFT JOIN
            sal_fees_trans a ON b.head_id = a.bhead_id
        WHERE
            a.student_id = '$stud_id'
            AND b.branch_id = '$branch_id'
            AND b.std = '$std'
            AND b.academic_year = '$academic_year'
        GROUP BY
            b.head";

        $feeBal = DB::select($query);

        return view('fees.balanceFees', compact('academic_year', 'feeBal', 'category'));
    }
}
