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
        Schema::create('project_managements', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->date('bid_date')->nullable();
            $table->bigInteger('bid_amount')->nullable();
            $table->integer('gpm')->nullable();
            $table->bigInteger('obligee_id')->nullable();
            $table->longText('obligee_address')->nullable();
            $table->integer('obligee_city')->nullable();
            $table->integer('obligee_state')->nullable();
            $table->text('obligee_zip')->nullable();

            $table->text('engineer_name')->nullable();
            $table->text('project_name')->nullable();
            $table->longText('project_address')->nullable();
            $table->integer('project_city')->nullable();
            $table->integer('project_state')->nullable();
            $table->text('project_zip')->nullable();

            $table->text('project_delivery_method')->nullable();
            $table->date('estimated_project_start_date')->nullable();
            $table->date('estimated_project_completion_date')->nullable();
            $table->longText('warranty_terms')->nullable();
            $table->text('liquidated_damages')->nullable();
            $table->integer('retainage_amount')->nullable();
            $table->longText('current_backlog')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('project_management');
    }
};
