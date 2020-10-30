<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClazzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clazz', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('status');
            $table->date('initial_date');
            $table->date('end_date');
            $table->string('name');
            $table->enum('shift',
                [
                    'MORNING',
                    'AFTERNOON',
                    'NIGHT',
                    'ONLINE',
                    'NO_SHIFT'
                ]
            );
            $table->enum('semester',
                [
                    'FIRST_SEMESTER',
                    'SECOND_SEMESTER',
                    'NO_SEMESTER'
                ]
            );

            $table->string('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->string('master_id')->nullable();
            $table->foreign('master_id')->references('id')->on('users');
            $table->string('program_id')->nullable();
            $table->foreign('program_id')->references('id')->on('programs');
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
        Schema::dropIfExists('clazz');
    }
}
