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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['Goods', 'People']);
            $table->string('registration_number')->unique();
            $table->string('fuel_consumption');
            $table->date('service_schedule');
            $table->string('last_kilometer');
            $table->enum('status', ['Active', 'Service', 'Nonaktif']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
