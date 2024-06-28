<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkTimetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ark_timetable', function (Blueprint $table) {
            $table->id();
            $table->string('period', 10);
            $table->string('day', 50);
            $table->string('sname', 300);
            $table->string('subject_id', 50);
            $table->string('branch_name', 500);
            $table->integer('branch_id');
            $table->integer('standard');
            $table->string('dv', 10);
            $table->string('teacher_name', 200);
            $table->integer('teacher_id');
            $table->string('academic_year', 20);
            $table->string('HM_approve', 100);
            $table->integer('pcount');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable()->useCurrentOnUpdate();

            // Adjust timestamps column if needed
            // $table->timestamp('created_at')->default(now());
            // $table->timestamp('updated_at')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ark_timetable');
    }
}

?>
