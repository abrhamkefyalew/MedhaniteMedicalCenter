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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id()->from(10000);

            // $table->foreignId('hospital_id')->nullable()->constrained('hospitals');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique(); // hidden from normal Users
            $table->string('phone_number')->unique()->nullable(); // hidden from normal Users
            $table->boolean('is_active')->default(1);
            $table->boolean('is_approved')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
