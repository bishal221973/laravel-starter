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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('price');
            $table->string('refundable')->nullable();
            $table->string('fromTime');
            $table->string('fromIataCode');
            $table->string('toTime');
            $table->string('toIataCode');
            $table->string('booking_refrence');
            $table->string('booking_id');
            $table->string('booking_date');
            $table->string('airline');
            $table->string('status');
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
