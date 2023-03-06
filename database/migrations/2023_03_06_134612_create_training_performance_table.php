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
        Schema::create('training_performance', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('training_date');
            $table->integer('swimmer_id')->unsigned();
            $table->foreign('swimmer_id')->references('id')->on('swimmers');
            $table->string('training_type')->nullable();
            $table->string('duration')->nullable();
            $table->string('distance')->nullable();
            $table->string('performance_score')->nullable();
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
