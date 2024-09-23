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
        Schema::table('bonds', function (Blueprint $table) {
            $table->text('name')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->text('zip')->nullable();
            $table->longText('address')->nullable();
            $table->integer('delivery_method')->nullable();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->longText('warranty_terms')->nullable();
            $table->longText('damages')->nullable();
            $table->longText('retain_amount')->nullable();
            $table->longText('current_backlog')->nullable();
            $table->integer('gpm')->nullable();
            $table->text('engineer_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bonds', function (Blueprint $table) {
            //
        });
    }
};
