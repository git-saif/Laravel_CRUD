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
        Schema::create('crud10s', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->foreignId('crud7_id')->constrained('crud7s')->onDelete('cascade'); // category required
            $table->foreignId('crud8_id')->nullable()->constrained('crud8s')->onDelete('set null'); // sub-category optional
            $table->foreignId('crud9_id')->nullable()->constrained('crud9s')->onDelete('set null'); // sub-sub optional

            // Post Fields
            $table->integer('post_serial')->unique();
            $table->string('post_name')->unique();
            $table->string('post_title');
            $table->text('short_description')->nullable();
            $table->longText('post');
            
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crud10s');
    }
};
