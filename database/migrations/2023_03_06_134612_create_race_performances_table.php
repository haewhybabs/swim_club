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
        Schema::create('race_performances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('swimmer_id')->unsigned();
            $table->foreign('swimmer_id')->references('id')->on('swimmers');
            $table->integer('squad_id')->unsigned()->nullable();
            $table->foreign('squad_id')->references('id')->on('squad');
            $table->string('race_type')->nullable(); //training or event
            $table->integer('stroke_id')->nullable()->unsigned();
            $table->foreign('stroke_id')->references('id')->on('strokes');
            $table->string('placement')->nullable();
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->integer('distance_id')->nullable()->unsigned();
            $table->foreign('distance_id')->references('id')->on('distances');
            $table->datetime('training_date')->nullable(); 
            $table->string('performance_score')->nullable();
            $table->integer('gala_event_id')->unsigned()->nullable();
            $table->foreign('gala_event_id')->references('id')->on('gala_events');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_performance');
    }
};
