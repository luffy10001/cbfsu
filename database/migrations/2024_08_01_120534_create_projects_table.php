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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('oblige_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->text('name')->nullable();
            $table->longText('address')->nullable();
            $table->text('zip')->nullable();
            $table->date('bid_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->bigInteger('bid_amount')->nullable();
            $table->integer('gpm')->nullable();
            $table->integer('delivery_method')->nullable();
            $table->longText('warranty_terms')->nullable();
            $table->longText('damages')->nullable();
            $table->longText('retain_amount')->nullable();
            $table->longText('current_backlog')->nullable();
            $table->text('engineer_name')->nullable();
            $table->longText('oblige_address')->nullable();
            $table->integer('oblige_city')->nullable();
            $table->integer('oblige_state')->nullable();
            $table->text('oblige_zip')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
