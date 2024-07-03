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
            ->pluck('category')->toArray(); 

        $query = "SELECT
            a.bhead_id,
            b.head,
            a.month,
            b.amount AS total_amount,
            a.amount AS paid_amount,
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
            ->pluck('category')->toArray(); 

        $cat_id = DB::table('sal_fees_trans')
            ->select('category_id')
            ->distinct()
            ->where('student_id', $stud_id)
            ->pluck('category_id')->toArray(); 

            // dd($cat_id);
    
        // Constructing the SQL query
        $query = "SELECT
            b.head,
            CASE WHEN b.head_id = 16 THEN (b.amount * 12) ELSE b.amount END AS total_amount,
            a.amount AS paid_amount
        FROM
            sal_fees_bhead b
        LEFT JOIN (
            SELECT
                bhead_id,
                SUM(amount) AS amount
            FROM
                sal_fees_trans
            WHERE
                student_id = '$stud_id'
            GROUP BY
                bhead_id
        ) a ON b.head_id = a.bhead_id
        WHERE
            b.branch_id = '$branch_id'
            AND b.std = '$std'
            AND b.academic_year = '$academic_year'
            AND b.category_id IN (" . implode(',', $cat_id) . ")";

        $feeBal = DB::select($query);

        return view('fees.balanceFees', compact('academic_year', 'feeBal', 'category'));
    }
}
