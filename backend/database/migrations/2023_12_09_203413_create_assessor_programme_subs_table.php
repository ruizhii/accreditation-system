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
        Schema::create('assessor_programme_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessor_programme_section_id')->constrained('assessor_programme_sections');
            $table->string('title');
            $table->string('standard_coppa');
            $table->string('keys_element');
            $table->longText('evidence');
            $table->string('coppa_requirement')->nullable();
            $table->string('evidence_status')->nullable();
            $table->string('notes')->nullable();
            $table->string('information_request')->nullable();
            $table->string('question')->nullable();
            $table->string('observation')->nullable();
            $table->string('suggested_score')->nullable();
            $table->string('panel_score')->nullable();
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
        Schema::dropIfExists('assessor_programme_subs');
    }
};
