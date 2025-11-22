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
        Schema::create('sortings', function (Blueprint $table) {
         $table->id();
         $table->string('category');       // e.g., Plastic, Organic, E-Waste
         $table->text('description');      // Instructions for residents
         $table->text('examples')->nullable();  // Optional, comma-separated examples
         $table->string('image')->nullable();   // Optional image illustrating the guide
         $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sortings');
    }
};
