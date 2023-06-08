<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGradesToResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_results', function (Blueprint $table) {
            $table->string('grade_quran')->nullable(true);
            $table->string('grade_arabic')->nullable(true);
            $table->string('grade_hadith')->nullable(true);
            $table->string('grade_azkar')->nullable(true);
            $table->string('grade_huruf')->nullable(true);
            $table->string('grade_muhadatha')->nullable(true);
            $table->string('grade_sirrah')->nullable(true);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_results', function (Blueprint $table) {
            //
        });
    }
}
