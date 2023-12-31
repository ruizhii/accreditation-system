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
            $table->string('sub');
            $table->longText('standard_coppa');
            $table->longText('keys_element');
            $table->longText('evidence');
            $table->string('coppa_requirement')->nullable();
            $table->string('evidence_status')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('information_request')->nullable();
            $table->longText('question')->nullable();
            $table->longText('observation')->nullable();
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
