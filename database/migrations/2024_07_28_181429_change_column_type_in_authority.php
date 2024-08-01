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
        Schema::table('authorities', function (Blueprint $table) {
            $table->bigInteger('single_job_limit')->change();
            $table->bigInteger('aggregate_limit')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authorities', function (Blueprint $table) {
            //
        });
    }
};
