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
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('cta_title')->nullable()->after('founded_year');
            $table->text('cta_description')->nullable()->after('cta_title');
            $table->string('cta_primary_button')->default('Mulai Galang Dana')->after('cta_description');
            $table->string('cta_secondary_button')->default('Pelajari Caranya')->after('cta_primary_button');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn(['cta_title', 'cta_description', 'cta_primary_button', 'cta_secondary_button']);
        });
    }
};
