<?php
// sana code

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalenderEvent extends Model
{
    use HasFactory;
    protected $table = 'ark_coe_reports';  
    
    protected $primaryKey = 'id';  
    public $timestamps = false;  
    
    protected $fillable = [
         
        'activity', 'date', 'description', 'files','academic_year','branch_id', 
    ];
}
 