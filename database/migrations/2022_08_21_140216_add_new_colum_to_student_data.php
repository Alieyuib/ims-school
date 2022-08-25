<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumToStudentData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_data', function (Blueprint $table) {
            $table->string('name_of_school');
            $table->string('Subject_learned');
            $table->string('ffname');
            $table->string('pob');
            $table->string('passport');
            $table->string('token');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_data', function (Blueprint $table) {
            //
        });
    }
}
