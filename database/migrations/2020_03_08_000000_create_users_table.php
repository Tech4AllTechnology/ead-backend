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
            $table->boolean('status');
            $table->date('birthday');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('profession')->nullable();
            $table->longText('identity_number');
            $table->string('issuing_authority');
            $table->date('issuing_date');
            $table->enum('marital_status', ['SOLTEIRO', 'CASADO', 'VIUVO', 'DIVORCIADO']);
            $table->longText('cpf');
            $table->enum('scholarship_level', [
                'FUNDAMENTAL_NAO_COMPLETO', 'FUNDAMENTAL_COMPLETO', 'MEDIO_NAO_COMPLETO', 'MEDIO_COMPLETO',
                'TECNICO_NAO_COMPLETO', 'TECNICO_COMPLETO', 'SUPERIOR_NAO_COMPLETO', 'SUPERIOR_COMPLETO'
            ]);
            $table->string('latest_school')->nullable();
            $table->longText('voter_id_number');
            $table->longText('voter_id_zone');
            $table->longText('voter_id_section');
            $table->date('scholarship_conclusion_date')->nullable();

            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('whatsapp_number')->nullable();

            $table->string('naturalness_country');
            $table->foreign('naturalness_country')->references('id')->on('country');

            $table->string('naturalness_state');
            $table->foreign('naturalness_state')->references('id')->on('states');

            $table->string('voter_id_state');
            $table->foreign('voter_id_state')->references('id')->on('states');

            $table->string('issuing_id_state');
            $table->foreign('issuing_id_state')->references('id')->on('states');


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