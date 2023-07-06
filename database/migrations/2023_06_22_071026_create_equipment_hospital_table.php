<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * // file and table name renamed from // equipment_hospitals to equipment_hospital
     */
    public function up(): void
    {
        Schema::create('equipment_hospital', function (Blueprint $table) {
            $table->id()->from(10000);

            $table->foreignId('hospital_id')->constrained('hospitals');
            $table->foreignId('equipment_id')->constrained('equipment');
            $table->unique(['hospital_id', 'equipment_id']);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_hospitals');
    }
};
