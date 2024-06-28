<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ark_attend', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_id')->unsigned();
            $table->string('student_id', 100)->nullable()->comment('ark_staff id');
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('subject_id')->unsigned()->comment('ark_subject id');
            $table->integer('fid')->unsigned()->nullable()->comment('ark_staff id');
            $table->integer('std')->unsigned()->comment('standard');
            $table->string('dv', 30)->nullable()->comment('division');
            $table->string('period', 5)->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->date('date')->nullable();
            $table->integer('atn')->unsigned();
            $table->string('academic_year', 30);
            $table->timestamps(0); // created_at and updated_at fields

            // Add indexes if needed
            $table->index('class_id');
            $table->index('student_id');
            $table->index('branch_id');
            $table->index('subject_id');
            $table->index('fid');
            $table->index('std');
            $table->index('dv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ark_attend');
    }
};
