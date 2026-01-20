<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campus_map_settings', function (Blueprint $table) {
            $table->text('embed_url')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('campus_map_settings', function (Blueprint $table) {
            $table->string('embed_url')->nullable()->change();
        });
    }
};
