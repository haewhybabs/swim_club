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
        Schema::create('gala_events', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('gala_date');
            $table->integer('distance_id')->unsigned();
            $table->foreign('distance_id')->references('id')->on('race_distance');
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gala_events');
    }
};
