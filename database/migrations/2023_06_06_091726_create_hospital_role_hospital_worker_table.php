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
            $table->unique(['role_id', 'admin_id']);
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
