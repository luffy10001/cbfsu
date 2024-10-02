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
        DB::statement('ALTER TABLE bonds ALTER COLUMN gpm TYPE DECIMAL(10, 2)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
