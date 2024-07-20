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
        Schema::create('insurers', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->integer('state_id');
            $table->string('underwriter_id');
            $table->text('name');
            $table->string('email')->unique();
            $table->longText('address');
            $table->string('zip');
            $table->string('phone');
            $table->integer('am_best_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurers');
    }
};
