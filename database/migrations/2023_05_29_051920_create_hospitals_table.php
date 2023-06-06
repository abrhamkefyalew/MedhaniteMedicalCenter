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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id()->from(10000);
            
            $table->string('hospital_name');
            $table->string('hospital_description')->nullable();
            $table->string('hospital_email')->unique()->nullable(); // test if mysql can accept multiple NULLs on UNIQUE column
            $table->string('hospital_phone_number')->unique()->nullable(); // test if mysql can accept multiple NULLs on UNIQUE column
            $table->json('hospital_working_hours')->nullable();
            $table->boolean('hospital_is_active')->default(1);
            $table->boolean('hospital_is_approved')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
