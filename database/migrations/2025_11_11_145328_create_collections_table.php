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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('collector_id'); 
            $table->unsignedBigInteger('resident_id')->nullable(); 
            $table->unsignedBigInteger('bin_id')->nullable();

            // Collection data
            $table->float('waste_weight')->default(0); // kg
            $table->dateTime('collected_at')->nullable();
            $table->enum('status', ['pending', 'collected', 'verified'])->default('pending');
            $table->text('notes')->nullable();

            $table->timestamps();

            // FK constraints
            $table->foreign('collector_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('set null');
            $table->foreign('bin_id')->references('id')->on('bins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};

