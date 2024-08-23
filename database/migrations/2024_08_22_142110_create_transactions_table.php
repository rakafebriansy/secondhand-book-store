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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('total_price');
            $table->unsignedBigInteger('user_id');
            $table->enum('status',['To Pay','To Ship','Completed','Cancelled'])->default('To Pay');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('admin_id')->on('admins')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
