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
            $table->string('sts_id', 20)->nullable();
            $table->string('gr_no', 50)->nullable();
            $table->string('student_id', 50)->nullable();
            $table->string('branch_id', 15)->nullable();
            $table->string('branch_name', 70)->nullable();
            $table->string('dept_id', 15)->nullable();
            $table->string('dept', 50)->nullable();
            $table->string('fees_type', 50);
            $table->integer('category_id');
            $table->string('fname', 50)->nullable();
            $table->string('lname', 50)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('gender', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('father_name', 50)->nullable();
            $table->string('father_occupation', 50);
            $table->string('f_mobile', 12)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('mother_occupation', 50);
            $table->string('m_mobile', 12)->nullable();
            $table->string('caste', 30)->nullable();
            $table->string('caste_category', 30)->nullable();
            $table->string('mother_toung', 30)->nullable();
            $table->string('academic_year', 10)->nullable();
            $table->string('class', 10)->nullable();
            $table->string('division', 20);
            $table->string('medium', 20)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('state', 30)->nullable();
            $table->string('district', 30)->nullable();
            $table->string('taluka', 30)->nullable();
            $table->string('village', 30)->nullable();
            $table->string('road', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('area', 30)->nullable();
            $table->integer('pin')->nullable();
            $table->string('password', 60)->nullable();
            $table->string('status', 10);
            $table->string('transfer', 30)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable()->useCurrentOnUpdate();
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
