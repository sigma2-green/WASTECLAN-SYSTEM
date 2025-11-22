<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // links to user who submitted the report
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // optional resident link (if you still want it)
            $table->foreignId('resident_id')->nullable()->constrained()->onDelete('set null');

            // optional bin link
            $table->foreignId('bin_id')->nullable()->constrained('bins')->onDelete('set null');

            $table->string('type')->default('general'); // general, missed_collection, broken_bin, etc.
            $table->text('description')->nullable();
            $table->string('photo')->nullable();

            $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reports');
    }
};


