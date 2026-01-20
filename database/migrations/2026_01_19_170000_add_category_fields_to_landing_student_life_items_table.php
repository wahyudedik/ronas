<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_student_life_items', function (Blueprint $table) {
            $table->string('category')->default('organizations')->after('title');
            $table->string('icon_class')->nullable()->after('image');
            $table->string('badge_text')->nullable()->after('icon_class');
        });
    }

    public function down(): void
    {
        Schema::table('landing_student_life_items', function (Blueprint $table) {
            $table->dropColumn(['category', 'icon_class', 'badge_text']);
        });
    }
};
