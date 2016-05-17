<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('telephone_number');
            $table->string('company');
            $table->string('function');
            $table->string('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reviewers');
    }
}
