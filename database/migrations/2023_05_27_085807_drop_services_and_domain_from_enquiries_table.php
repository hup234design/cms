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
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn('services');
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn('domain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->json('services')->after('subject')->nullable();
            $table->string('domain')->after('message')->nullable();
        });
    }
};
