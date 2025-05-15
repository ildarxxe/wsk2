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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('x');
            $table->integer('y');
            $table->enum('type', ['Attraction','Restaurant']);
            $table->string('image_path', 50);
            $table->time('open_time');
            $table->time('close_time');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
