<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')-> create('category', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('name')->default('');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql')-> create('answer', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('content')->default('');
            $table->boolean('isCorrect')->default(true);
            $table->timestamps();
            $table->engine = 'InnoDB';

        });

        Schema::connection('mysql')->create('list_lesson', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->boolean('released')->default(true);
            $table->string('category')->default('');
            $table->string('name')->default('');
            $table->string('description')->default('');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql')->create('questions', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->integer('answers_id')->unsigned();
            $table->string('question')->default('');
            $table->string('category')->default('');  
            $table->timestamps();
            $table->foreign('answers_id')->references('id')->on('answer');;
            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->drop('category');
        Schema::connection('mysql')->drop('answer');
        Schema::connection('mysql')->drop('list_lesson');
        Schema::connection('mysql')->drop('questions');
    }
}
