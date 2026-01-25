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
        Schema::table('news', function (Blueprint $table) {
            // Remove old column if exists, careful with data loss in prod but fine here
            $table->dropColumn('category');
            $table->dropColumn('author_name'); // We will use relation

            $table->foreignId('category_id')->nullable()->constrained('news_categories')->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('draft'); // draft, published, archived
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('event_date');
            $table->dropColumn('event_time');
            $table->dropColumn('location');
            $table->dropColumn('participants'); // Maybe not needed if we have registrations, or keep as text summary

            $table->foreignId('category_id')->nullable()->constrained('event_categories')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('venue')->nullable();
            $table->text('address')->nullable();
            $table->integer('capacity')->nullable();
            $table->dateTime('registration_deadline')->nullable();
            $table->string('status')->default('upcoming'); // upcoming, ongoing, past, cancelled
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->string('author_name')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
            $table->dropColumn('status');
            $table->dropColumn('meta_keywords');
            $table->dropColumn('meta_description');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('location')->nullable();
            $table->string('participants')->nullable();

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('venue');
            $table->dropColumn('address');
            $table->dropColumn('capacity');
            $table->dropColumn('registration_deadline');
            $table->dropColumn('status');
        });
    }
};
