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
        Schema::table('fundraisings', function (Blueprint $table) {
            $table->string('category')->after('description');
            $table->date('end_date')->after('target_amount');
            $table->string('phone')->after('organization_name');
            $table->foreignId('user_id')->nullable()->after('status')->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fundraisings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['category', 'end_date', 'phone', 'user_id']);
        });
    }
};
