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
            $table->longText('perf_contract_detail')->nullable();
            $table->date('perf_contract_date')->nullable();
            $table->bigInteger('perf_contract_amount')->nullable();
            $table->longText('perf_description')->nullable();
            $table->longText('perf_bond_detail')->nullable();
            $table->date('perf_date')->nullable();
            $table->bigInteger('perf_amount')->nullable();
            $table->text('perf_contract_document')->nullable();
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
