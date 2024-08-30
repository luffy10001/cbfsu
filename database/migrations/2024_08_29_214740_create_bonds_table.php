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
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->text('owner_name')->nullable();
            $table->integer('owner_state')->nullable();
            $table->integer('owner_city')->nullable();
            $table->text('owner_zip')->nullable();
            $table->longText('owner_address')->nullable();
            $table->date('owner_bid_date')->nullable();
            $table->date('bid_start_date')->nullable();
            $table->date('bid_completion_date')->nullable();
            $table->bigInteger('bid_amount')->nullable();
            $table->bigInteger('bid_project_cost')->nullable();
            $table->integer('bid_amount_percentage')->nullable();
            $table->integer('bid_warranty_period')->nullable();
            $table->bigInteger('bid_damages')->nullable();
            $table->date('pb_contract_date')->nullable();
            $table->bigInteger('pb_contract_amount')->nullable();
            $table->bigInteger('pb_estimated_profit')->nullable();
            $table->date('pb_start_date')->nullable();
            $table->date('pb_completion_date')->nullable();
            $table->integer('pb_warranty_period')->nullable();
            $table->biginteger('pb_damages')->nullable();
            $table->longText('attachment')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonds');
    }
};
