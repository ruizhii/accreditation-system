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
        Schema::create('assessor_programme_areas', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->string('progress_percentage');
            $table->foreignId('assessor_programme_id')->constrained('assessor_programmes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessor_programme_areas');
    }
};
