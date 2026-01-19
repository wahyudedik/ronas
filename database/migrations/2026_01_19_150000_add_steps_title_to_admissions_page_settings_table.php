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
        Schema::table('admissions_page_settings', function (Blueprint $table) {
            $table->string('steps_title')->nullable()->after('breadcrumb_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions_page_settings', function (Blueprint $table) {
            $table->dropColumn('steps_title');
        });
    }
};
