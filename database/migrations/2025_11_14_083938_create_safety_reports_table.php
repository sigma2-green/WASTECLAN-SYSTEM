<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('safety_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collector_id')->constrained()->onDelete('cascade');
            $table->text('issue');
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('safety_reports');
    }
};

