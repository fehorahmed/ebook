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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->unsignedBigInteger('writer_id')->nullable()->index();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('content_title')->nullable();
            $table->longText('content_description')->nullable();
            $table->integer('like_count')->nullable()->default(0);
            $table->string('ad_link')->nullable();
            $table->integer('ad_count')->nullable()->default(0);
            $table->integer('ad_coin')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
