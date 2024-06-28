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
        Schema::create('ark_student_info', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 30);
            $table->string('sts_id', 30)->nullable();
            $table->string('name', 50);
            $table->string('gender', 10)->nullable();
            $table->string('user_name', 30)->nullable();
            $table->string('password', 30)->nullable();
            $table->integer('branch_id');
            $table->string('branch_name', 70);
            $table->string('mobile_no', 20)->nullable();
            $table->string('pmobil_no', 20)->nullable();
            $table->string('dob', 10)->nullable();
            $table->string('cast', 10)->nullable();
            $table->string('father_name', 50)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('mail', 20)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->integer('status')->comment('0=pending\n1=active\n2=reject');
            $table->integer('uid');
            $table->string('academic_year', 20);
            $table->string('photo_path', 50)->nullable();
            $table->timestamp('c_date')->useCurrent();
            $table->timestamp('u_date')->useCurrent()->useCurrentOnUpdate();

            // Add indexes
            $table->index('student_id');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ark_student_info');
    }
};
