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
            $table->string('title');
            $table->string('type')->nullable();
            $table->integer('phase_num')->nullable();
            $table->date('accredited_date')->nullable();
            $table->date('mqr_recorded_accredited_date')->nullable();
            $table->string('jpt_approval_letter_reference_number')->nullable();
            $table->string('remarks')->nullable();
            //asraf's
            $table->string('matter_expert_panel')->nullable();
            $table->string('insider_panel')->nullable();
            $table->date('submission_panel_due_date')->nullable();
            $table->date('panel_meeting_date')->nullable();
            $table->date('faculty_visit_date')->nullable();
            $table->date('closing_meeting_date')->nullable();
            $table->date('panel_report_qmec_date')->nullable();
            $table->date('report_mqa_date')->nullable();
            $table->string('status')->nullable();
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
