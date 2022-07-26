<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewRow2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registered_courses', function (Blueprint $table) {
            //
            $table->string('sub_one_scores');
            $table->string('sub_two_scores');
            $table->string('sub_three_scores');
            $table->string('sub_four_scores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registered_courses', function (Blueprint $table) {
            //
        });
    }
}
