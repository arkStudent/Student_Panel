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
        Schema::create('ark_period', function (Blueprint $table) {
            $table->id();
            $table->string('period', 10);
            $table->time('stime');
            $table->time('etime');
            $table->string('branch_id', 20);
            $table->string('standard', 20);
            $table->string('academic_year', 20);
            $table->string('dept_id', 20);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ark_period');
    }
};
