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
        Schema::create('athlete_dspl', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aic_id')->unsigned();
            $table->unsignedBigInteger('dspl_id')->unsigned();

            $table->foreign('aic_id')->references('id')->on('athlete_in_comps')->cascadeOnDelete();
            $table->foreign('dspl_id')->references('id')->on('disciplines')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athlete_dspl');
    }
};
