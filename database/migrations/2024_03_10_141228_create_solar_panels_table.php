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
        Schema::create('solar_panels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('number')->default(0);
            $table->integer('light_level')->default(0);
            $table->integer('battery')->default(0);
            $table->integer('production')->default(0);
            $table->integer('ambient_temperature')->default(0);
            $table->integer('humidity')->default(0);
            $table->integer('panel_temperature')->default(0);
            // Making the FK ids
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            // Making the FK constraints
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_panels');
    }
};
