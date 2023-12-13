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
        Schema::create('assessor_programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessor_id')->constrained('assessors');
            $table->foreignId('programme_id')->constrained('academic_programmes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessor_programmes');
    }
};
