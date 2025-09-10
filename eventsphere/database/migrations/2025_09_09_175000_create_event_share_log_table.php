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
        Schema::create('event_share_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   // who shared
            $table->unsignedBigInteger('event_id');  // which event
            $table->string('platform');              // Facebook, WhatsApp, LinkedIn...
            $table->timestamp('share_timestamp')->nullable();
            $table->text('share_message')->nullable(); // auto-generated message/caption
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_share_log');
    }
};
