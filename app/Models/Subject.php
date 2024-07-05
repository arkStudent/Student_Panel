<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'ark_lesson_plan';
    protected $primaryKey = 'slno';  
    public $timestamps = false;  

}