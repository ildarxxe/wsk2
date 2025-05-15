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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('line');
            $table->integer('from_place_id');
            $table->integer('to_place_id');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('distance');
            $table->integer('speed');
            $table->enum('status', ['AVAILABLE', 'UNAVAILABLE']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
