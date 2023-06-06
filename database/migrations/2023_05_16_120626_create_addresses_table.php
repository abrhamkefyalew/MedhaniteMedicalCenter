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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id()->from(10000);

            $table->morphs('addressable');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('sub_city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('fax')->nullable();
            $table->string('po_box')->nullable();
            $table->string('relative_location')->nullable();
            $table->string('latitude')->nullable(); // should they be double  or string
            $table->string('longitude')->nullable(); // should they be double  or string
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
