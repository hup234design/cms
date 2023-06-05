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
        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropColumn('header_title');
        });

        Schema::table('index_pages', function (Blueprint $table) {
            $table->string('heading_title')->after('featured_image_id')->nullable();
            $table->string('heading_subtitle')->after('heading_title')->nullable();
            $table->foreignId('slider_id')->after('featured_image_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropForeign('index_pages_slider_id_foreign');
        });

        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropColumn('slider_id');
        });

        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropColumn('heading_subtitle');
        });

        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropColumn('heading_title');
        });

        Schema::table('index_pages', function (Blueprint $table) {
            $table->json('header_title')->after('featured_image_id')->nullable();
        });
    }
};
