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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('sent_by_user_id')->nullable();
            $table->text('message')->nullable();
            $table->string('refrence_id')->nullable();
            $table->text('modal_name')->nullable();
            $table->text('message_type')->nullable();
            $table->boolean('is_read')->default(0);
            $table->text('page_route_name')->nullable();
            $table->text('action_route')->nullable();
            $table->boolean('is_modal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
