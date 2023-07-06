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
        Schema::create('doctor_speciality', function (Blueprint $table) {
            $table->id()->from(10000);

            $table->foreignId('doctor_id')->constrained('doctors');
            $table->foreignId('speciality_id')->constrained('specialities');
            $table->unique(['doctor_id', 'speciality_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_speciality');
    }
};
