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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_tagline');
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('company_address');
            $table->string('company_favicon')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_booking_link')->nullable();
            $table->string('company_whatsapp_link')->nullable();
            $table->string('company_facebook_link')->nullable();
            $table->string('company_instagram_link')->nullable();
            $table->string('company_twitter_link')->nullable();
            $table->string('company_youtube_link')->nullable();
            $table->string('company_linkedin_link')->nullable();
            $table->string('company_google_map_link')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
