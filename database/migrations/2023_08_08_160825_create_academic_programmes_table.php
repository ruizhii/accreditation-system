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
        Schema::create('academic_programmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('graduate_level');
            $table->string('study_mode');
            $table->string('nec_2010');
            $table->string('nec_2020');
            $table->integer('min_semester');
            $table->integer('max_semester');
            $table->integer('required_graduation_credit');
            $table->string('degree_qualification_type');
            $table->foreignIdFor(\App\Models\Faculty::class)->constrained();
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
        Schema::dropIfExists('academic_programmes');
    }
};
