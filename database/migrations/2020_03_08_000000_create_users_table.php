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
            $table->uuid('id')->primary();
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

            $table->string('naturalness_country');
            $table->foreign('naturalness_country')->references('id')->on('country');

            $table->string('naturalness_state');
            $table->foreign('naturalness_state')->references('id')->on('state');

            $table->string('voter_id_state');
            $table->foreign('voter_id_state')->references('id')->on('state');

            $table->string('polo_id');
            $table->string('course_id');

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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