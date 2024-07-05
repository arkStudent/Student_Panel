<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamDetails extends Model
{
    protected $table = 'sal_exam_marks'; // Specify the table name if it's different
    protected $primaryKey = 'id'; // Adjust the primary key if it's different
    public $timestamps = false; // Assuming 'sal_exam_mark' doesn't have timestamp columns

    protected $fillable = [
        'subject',
        'attendance',
        //'max_marks',
        'i_marks',
        'w_marks',
        't_marks',
        'grade',
        'student_id',
        'academic_year',
        'ex_id',
        'ex_name',
        // Add other fields as needed
    ];

    // Add relationships or additional methods as necessary
}
