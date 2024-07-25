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
        Schema::create('authorities', function (Blueprint $table) {
            $table->id();
            $table->integer('insurer_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('single_job_limit')->nullable();
            $table->integer('aggregate_limit')->nullable();
            $table->integer('territory')->nullable();
            $table->integer('territory_unit')->nullable();
            $table->integer('job_duration')->nullable();
            $table->integer('job_duration_unit')->nullable();
            $table->integer('warranty_duration')->nullable();
            $table->integer('warranty_duration_unit')->nullable();
            $table->integer('payment_interval')->nullable();
            $table->integer('payment_interval_unit')->nullable();
            $table->integer('minimum_bid')->nullable();
            $table->integer('maintenance_limit')->nullable();
            $table->integer('maintenance_limit_unit')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authority_lines', function (Blueprint $table) {
            //
        });
    }
};
