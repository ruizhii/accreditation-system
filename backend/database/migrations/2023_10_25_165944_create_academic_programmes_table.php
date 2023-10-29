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
            $table->string('mqf_level')->nullable();
            $table->string('mqr_no')->nullable();
            $table->string('required_graduating_credit')->nullable();
            $table->string('accredited_um')->nullable();
            $table->string('award_type')->nullable();
            $table->string('old_nec')->nullable();
            $table->string('new_nec')->nullable();
            $table->string('location_conducted')->nullable();
            $table->string('instruction_language')->nullable();
            $table->string('programme_type')->nullable();
            $table->longText('student_enrolment')->nullable();
            $table->string('programme_status')->nullable();
            $table->string('study_mode')->nullable();
            $table->string('graduate_level')->nullable();
            $table->string('offer_mode')->nullable();
            $table->string('teaching_method')->nullable();
            $table->string('graduate_job_type')->nullable();
            $table->string('delivery_mode')->nullable();
            $table->string('study_duration')->nullable();
            $table->string('first_intake_date')->nullable();
            $table->string('graduation_date')->nullable();
            $table->longText('awarding_body')->nullable();
            $table->longText('scroll_awarded')->nullable();
            $table->string('programme_coordinator')->nullable();
            $table->foreignIdFor(\App\Models\Department::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_programmes');
    }
};