<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('event_seating', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->primary();
            $table->string('venue');
            $table->integer('total_seats');
            $table->integer('seats_booked')->default(0);
            $table->boolean('waitlist_enabled')->default(true);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_seating');
    }
};
