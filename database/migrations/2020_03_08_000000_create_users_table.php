<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('application')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status');
            $table->date('birthday');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('profession');
            $table->string('identity_number');
            $table->string('issuing_authority');
            $table->date('issuing_date');
            $table->string('marital_status');
            $table->bigInteger('cpf');
            $table->string('scholarship_level'); //check if its going to be string
            $table->string('latest_school');
            $table->string('voter_id_number');
            $table->string('voter_id_zone');
            $table->string('voter_id_section');

            $table->integer('naturalness_country')->unsigned();
            $table->foreign('naturalness_country')->references('id')->on('country');

            $table->integer('naturalness_state')->unsigned();
            $table->foreign('naturalness_state')->references('id')->on('state');

            $table->integer('voter_id_state')->unsigned();
            $table->foreign('voter_id_state')->references('id')->on('state');

            $table->integer('polo_id')->unsigned();
            $table->integer('course_id')->unsigned();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}