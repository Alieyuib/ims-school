<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_results', function (Blueprint $table) {
            $table->id();
            $table->string('student_name')->nullable(true);
            $table->string('student_class')->nullable(true);
            $table->string('no_in_class')->nullable(true);
            $table->string('class_teacher_remarks')->nullable(true);
            $table->string('head_teacher_remarks')->nullable(true);
            $table->string('average')->nullable(true);
            $table->string('term')->nullable(true);
            $table->string('date')->nullable(true);
            $table->string('obtained_scores_quran')->nullable(true);
            $table->string('exams_scores_quran')->nullable(true);
            $table->string('ca_scores_quran')->nullable(true);
            $table->string('cw_scores_quran')->nullable(true);
            $table->string('total_scores_quran')->nullable(true);
            $table->string('obtained_scores_arabic')->nullable(true);
            $table->string('exams_scores_arabic')->nullable(true);
            $table->string('ca_scores_arabic')->nullable(true);
            $table->string('cw_scores_arabic')->nullable(true);
            $table->string('total_scores_arabic')->nullable(true);
            $table->string('obtained_scores_hadith')->nullable(true);
            $table->string('exams_scores_hadith')->nullable(true);
            $table->string('ca_scores_hadith')->nullable(true);
            $table->string('cw_scores_hadith')->nullable(true);
            $table->string('total_scores_hadith')->nullable(true);
            $table->string('obtained_scores_azkar')->nullable(true);
            $table->string('exams_scores_azkar')->nullable(true);
            $table->string('ca_scores_azkar')->nullable(true);
            $table->string('cw_scores_azkar')->nullable(true);
            $table->string('total_scores_azkar')->nullable(true);
            $table->string('obtained_scores_huruf')->nullable(true);
            $table->string('exams_scores_huruf')->nullable(true);
            $table->string('ca_scores_huruf')->nullable(true);
            $table->string('cw_scores_huruf')->nullable(true);
            $table->string('total_scores_huruf')->nullable(true);
            $table->string('obtained_scores_muhadatha')->nullable(true);
            $table->string('exams_scores_muhadatha')->nullable(true);
            $table->string('ca_scores_muhadatha')->nullable(true);
            $table->string('cw_scores_muhadatha')->nullable(true);
            $table->string('total_scores_muhadatha')->nullable(true);
            $table->string('obtained_scores_sirrah')->nullable(true);
            $table->string('exams_scores_sirrah')->nullable(true);
            $table->string('ca_scores_sirrah')->nullable(true);
            $table->string('cw_scores_sirrah')->nullable(true);
            $table->string('total_scores_sirrah')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_results');
    }
}
