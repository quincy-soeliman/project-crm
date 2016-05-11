<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStundentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('college_id');
            $table->integer('reviewer_id');
            $table->string('ov_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('telephone_number');
            $table->string('college');
            $table->string('reviewer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
