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
        Schema::create('crud8s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crud7_id')->constrained('crud7s')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('serial_no')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crud8s');
    }
};
