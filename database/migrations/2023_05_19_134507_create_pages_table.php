<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('sort_order')->default(1);
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->json('content_blocks')->nullable();
            $table->boolean('visible')->default(true);
            $table->foreignId('featured_image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->json('header_title')->nullable();
            $table->json('header_links')->nullable();
            $table->foreignId('header_image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('seo_image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
