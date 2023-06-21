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
            $table->longText('content')->after('slug')->nullable();
        });

        Schema::table('index_pages', function (Blueprint $table) {
            $table->longText('content')->after('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('index_pages', function (Blueprint $table) {
            $table->dropColumn('content');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
};
