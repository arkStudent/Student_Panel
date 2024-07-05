<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'sal_exam_type';
    protected $primaryKey = 'slno';  
    public $timestamps = false; 
    
    
    protected $fillable = [
        'branch_id',
        'ename',
        // Add other fields as needed
    ];
    
}