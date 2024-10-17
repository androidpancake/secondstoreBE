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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid();
            $table->string('cust_name');
            $table->string('cust_phone');
            $table->string('cust_email');
            $table->integer('amount');
            $table->integer('cust_price');
            $table->boolean('is_approve');
            $table->dateTime('expired_date');
            $table->boolean('is_active');
            $table->foreignUuid('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
