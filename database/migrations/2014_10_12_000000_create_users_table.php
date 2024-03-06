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
        Schema::create('users', function (Blueprint $table) {
            $indonesiaPrefix = config('indonesia.table_prefix');

            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('phonecode')
                ->nullable()
                ->foreign('phonecode')
                ->references('phonecode')
                ->on('countries');
            $table->char('province_code', 2)
                ->nullable()
                ->foreign('province_code')
                ->references('code')
                ->on($indonesiaPrefix . 'provinces');
            $table->char('city_code', 4)
                ->nullable()
                ->foreign('city_code')
                ->references('code')
                ->on($indonesiaPrefix . 'cities');
            $table->char('district_code', 7)
                ->nullable()
                ->foreign('district_code')
                ->references('code')
                ->on($indonesiaPrefix . 'districts');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
