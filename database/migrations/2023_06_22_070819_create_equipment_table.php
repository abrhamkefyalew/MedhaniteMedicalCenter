<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * // the file becomes = 2023_06_22_070819_create_equipment_table.php
     * // the table name becomes = equipment
     * // this is because plural of equipment is equipment
     * // so laravel considers this and creates a table named = equipment
     */
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id()->from(10000);

            $table->foreignId('equipment_type_id')->constrained('equipment_types');
            $table->string('name')->unique();
            $table->string('equipment_description')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
