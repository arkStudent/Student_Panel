<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ark_students', function (Blueprint $table) {
            $table->id();
            $table->string('sts_id', 30)->nullable();
            $table->string('gr_no', 30)->nullable();
            $table->string('student_id', 30)->nallable(); 
            $table->string('branch_id')->nallable();
            $table->string('branch_name')->nallable();          
            $table->string('dept_id')->nallable();          
            $table->string('dept')->nallable();          
            $table->string('fees_type', 50);
            $table->string('category_id', 10);
            $table->string('fname', 30)->nullable();
            $table->string('lname', 30)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('date_of_birth', 10)->nullable();
            $table->string('father_name', 50)->nullable();
            $table->string('father_occupation', 50);
            $table->string('f_mobile', 12)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('mother_occupation', 50);
            $table->string('m_mobile', 12)->nullable();
            $table->string('cast', 30)->nullable();
            $table->string('caste_category', 30)->nullable();           
            $table->string('mother_toung', 30)->nullable();
            $table->string('academic_year', 20)->nullable();
            $table->string('class', 10)->nullable();
            $table->string('division', 10);
            $table->string('medium', 30)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('state', 1000)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('taluka', 50)->nullable();            
            $table->string('village', 50)->nullable();            
            $table->string('road', 50)->nullable();            
            $table->string('street', 50)->nullable();            
            $table->string('area', 50)->nullable();            
            $table->string('pin', 50)->nullable();            
            $table->string('password', 50)->nullable(); 
            $table->integer('status')->comment('0=pending\n1=active\n2=reject');           
            $table->string('transfer', 50)->nullable();                        
            $table->timestamp('c_date')->useCurrent();
            $table->timestamp('u_date')->useCurrent()->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ark_students');
    }
};
