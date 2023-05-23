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
        Schema::table('pages', function (Blueprint $table) {
            $table->json('header_blocks')->after('content_blocks')->nullable();
        });
        Schema::table('index_pages', function (Blueprint $table) {
            $table->json('header_blocks')->after('content_blocks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropColumn('header_blocks');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('header_blocks');
        });
    }
};
