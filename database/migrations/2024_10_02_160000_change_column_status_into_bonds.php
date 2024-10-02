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
        DB::statement('ALTER TABLE bonds ALTER COLUMN status DROP DEFAULT');
        DB::statement('ALTER TABLE bonds ALTER COLUMN status TYPE integer USING status::integer');
//        DB::statement('ALTER TABLE bonds ALTER COLUMN status SET DEFAULT your_default_value');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
