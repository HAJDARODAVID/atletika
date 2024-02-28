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
        Schema::create('dspl_for_year', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->bigInteger('year_id')->unsigned();
            $table->bigInteger('dspl_id')->unsigned();

            $table->foreign('year_id')->references('year')->on('years');
            $table->foreign('dspl_id')->references('id')->on('disciplines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dspl_for_year');
    }
};
