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
        Schema::create('crud9s', function (Blueprint $table) {
            $table->id();
            // parent points to subcategory (crud8s)
            $table->foreignId('crud8_id')->constrained('crud8s')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('serial_no')->unique();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crud9s');
    }
};
