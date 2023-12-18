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
        Schema::create('assessor_programme_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessor_programme_area_id')->constrained('assessor_programme_areas');
            $table->string('section');
            $table->string('title');
            $table->string('suggested_score')->default(0);
            $table->string('panel_score')->default(0);
            $table->longText('commendations')->nullable();
            $table->longText('affirmations')->nullable();
            $table->longText('recommendations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessor_programme_sections');
    }
};
