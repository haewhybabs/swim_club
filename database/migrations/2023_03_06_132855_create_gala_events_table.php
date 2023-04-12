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
            $table->string('name');
            $table->datetime('gala_date');
            $table->integer('distance_id')->unsigned();
            $table->foreign('distance_id')->references('id')->on('distances');
            $table->integer('stroke_id')->nullable()->unsigned();
            $table->foreign('stroke_id')->references('id')->on('strokes');
            $table->string('race_type')->nullable(); //adult or child
            $table->string('gender')->nullable();
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
