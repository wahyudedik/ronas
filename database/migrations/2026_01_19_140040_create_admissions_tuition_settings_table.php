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
        Schema::create('admissions_tuition_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('aid_title')->nullable();
            $table->text('aid_description')->nullable();
            $table->string('aid_button_label')->nullable();
            $table->string('aid_button_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions_tuition_settings');
    }
};
