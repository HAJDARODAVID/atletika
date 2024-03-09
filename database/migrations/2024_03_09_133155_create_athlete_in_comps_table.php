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
        Schema::create('athlete_in_comps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comp_id')->unsigned()->nullable();
            $table->unsignedBigInteger('app_id')->unsigned()->nullable();
            $table->unsignedBigInteger('athlete_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('comp_id')->references('id')->on('competitions')->cascadeOnDelete();
            $table->foreign('app_id')->references('id')->on('application_forms')->cascadeOnDelete();
            $table->foreign('athlete_id')->references('id')->on('athlete')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athlete_in_comps');
    }
};
