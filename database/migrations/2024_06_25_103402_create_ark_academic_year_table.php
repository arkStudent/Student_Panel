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
        Schema::create('ark_academic_year', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('academic_year', 11);
            $table->string('status', 20);
            $table->integer('min_wl');
            $table->integer('max_wl');
            $table->timestamp('cdate')->useCurrent();
            $table->dateTime('udate')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ark_academic_year');
    }
};
