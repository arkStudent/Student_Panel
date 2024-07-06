<?php
// sana code

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamDetails extends Model
{
    protected $table = 'sal_exam_marks'; 
    protected $primaryKey = 'id'; 
    public $timestamps = false; 

    protected $fillable = [
        'subject',
        'attendance',
        'i_marks',
        'w_marks',
        't_marks',
        'grade',
        'student_id',
        'academic_year',
        'ex_id',
        'ex_name',
    ];
}
