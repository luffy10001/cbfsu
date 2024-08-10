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
        Schema::table('insurers', function (Blueprint $table) {
            $table->string('treasury_list')->nullable();
            $table->text('website')->nullable();
            $table->string('cbu_name')->nullable();
            $table->string('cbu_phone')->nullable();
            $table->string('cbu_email')->nullable();
            $table->string('clbu_name')->nullable();
            $table->string('clbu_phone')->nullable();
            $table->string('clbu_email')->nullable();
            $table->text('attorney')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insurers', function (Blueprint $table) {
            //
        });
    }
};
