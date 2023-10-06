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
        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('phase_num');
            $table->date('accredited_date');
            $table->date('expiry_date')->nullable();
            $table->date('mqr_recorded_accredited_date')->nullable();
            $table->string('jpt_approval_letter_reference_number')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignIdFor(\App\Models\AcademicProgramme::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditations');
    }
};
