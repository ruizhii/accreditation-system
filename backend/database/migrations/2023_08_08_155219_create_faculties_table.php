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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 //Faculty name
            $table->string('director_name')->nullable();      //Director name
            $table->string('director_email')->nullable();       //Director email
            $table->string('tel')->nullable();                  //Faculty telephone number
            $table->string('fax')->nullable();                  //Faculty fax
            $table->string('website')->nullable();              //Faculty website
            $table->json('department')->nullable();             //List of departments in the faculty and number of programmes offered
            $table->json('academic_staff')->nullable();         //Total number of academic staff
            $table->json('no_student')->nullable();             //Number of student based on gender and disability
            $table->json('student_attrition')->nullable();      //Student attrition
            $table->longText('organizational_chart')->nullable(); //Faculty organizational chart(url)
            $table->json('annual_allocation')->nullable();  //Annual allocation past 1,2 and 3 year
            $table->json('administrative_staff')->nullable();   //Total number of administrative and support staff
            $table->json('programme_leader')->nullable();       //Detatils of Programme Leader
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
        Schema::dropIfExists('faculties');
    }
};
