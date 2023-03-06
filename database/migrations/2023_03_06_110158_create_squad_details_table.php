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
        Schema::create('squad_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('swimmer_id')->unsigned();
            $table->foreign('swimmer_id')->references('id')->on('swimmers');
            $table->integer('squad_id')->unsigned();
            $table->foreign('squad_id')->references('id')->on('squad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('squad_details');
    }
};
