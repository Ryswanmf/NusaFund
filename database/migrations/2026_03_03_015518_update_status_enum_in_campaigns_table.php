<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Gunakan DB Statement karena change() pada ENUM sering bermasalah di beberapa versi
        DB::statement("ALTER TABLE campaigns MODIFY COLUMN status ENUM('active', 'inactive', 'completed', 'suspended') DEFAULT 'active'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE campaigns MODIFY COLUMN status ENUM('active', 'completed', 'suspended') DEFAULT 'active'");
    }
};
