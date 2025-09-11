<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Add 'rejected' to the ENUM without removing existing values
        DB::statement("ALTER TABLE `registrations` MODIFY COLUMN `status` ENUM('confirmed', 'cancelled', 'waitlist', 'rejected') NOT NULL DEFAULT 'waitlist'");
    }

    public function down()
    {
        // Revert back to original ENUM
        DB::statement("ALTER TABLE `registrations` MODIFY COLUMN `status` ENUM('confirmed', 'cancelled', 'waitlist') NOT NULL DEFAULT 'waitlist'");
    }
};
