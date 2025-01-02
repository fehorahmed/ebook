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
        Schema::create('ad_settings', function (Blueprint $table) {
            $table->id();
            $table->longtext('details_page_ad_one')->nullable();
            $table->longtext('details_page_ad_two')->nullable();
            $table->longtext('details_page_ad_three')->nullable();
            $table->longtext('details_page_ad_four')->nullable();
            $table->longtext('details_page_ad_five')->nullable();
            $table->longtext('details_page_ad_six')->nullable();
            $table->longtext('home_page_ad_one')->nullable();
            $table->longtext('home_page_ad_two')->nullable();
            $table->longtext('home_page_ad_three')->nullable();
            $table->longtext('home_page_ad_four')->nullable();
            $table->longtext('home_page_ad_five')->nullable();
            $table->longtext('category_page_ad_one')->nullable();
            $table->longtext('category_page_ad_two')->nullable();
            $table->longtext('category_page_ad_three')->nullable();
            $table->longtext('category_page_ad_four')->nullable();
            $table->longtext('category_page_ad_five')->nullable();
            $table->longtext('writer_page_ad_one')->nullable();
            $table->longtext('writer_page_ad_two')->nullable();
            $table->longtext('writer_page_ad_three')->nullable();
            $table->longtext('writer_page_ad_four')->nullable();
            $table->longtext('writer_page_ad_five')->nullable();
            $table->longtext('single_page_ad_one')->nullable();
            $table->longtext('single_page_ad_two')->nullable();
            $table->longtext('single_page_ad_three')->nullable();
            $table->longtext('single_page_ad_four')->nullable();
            $table->longtext('single_page_ad_five')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_settings');
    }
};
