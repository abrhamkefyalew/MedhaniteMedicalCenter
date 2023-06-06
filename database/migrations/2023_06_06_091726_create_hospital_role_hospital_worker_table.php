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
        Schema::create('hospital_role_hospital_worker', function (Blueprint $table) {
            $table->id()->from(10000);

            $table->foreignId('hospital_role_id')->constrained('hospital_roles');
            $table->foreignId('hospital_worker_id')->constrained('hospital_workers');
            $table->unique(['hospital_role_id', 'hospital_worker_id'], 'h_role_h_worker_h_role_id_h_worker_id'); // giving custom index name // should not exceed 64 chars
            $table->timestamp('expire_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_role_hospital_worker');
    }
};
