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

        Schema::connection('mysql')-> create('answer', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->string('content')->default('');
            $table->boolean('isCorrect')->default(true);
            
            $table->engine = 'InnoDB';
        });
        DB::connection('mysql')->table('answer')->insert([
            [
                "content"=> "JavaScript 0",
                "isCorrect"=> false
            ],
            [
                "content"=> "JavaScript 1",
                "isCorrect"=> false
            ],
            [
                "content"=> "JavaScript 2",
                "isCorrect"=> true
            ],
            [
                "content"=> "JavaScript 3",
                "isCorrect"=> false
            ],
            [
                "content"=> "JavaScript 4",
                "isCorrect"=> false
            ],
            [
                "content"=> "JavaScript 5",
                "isCorrect"=> true
            ]
        ]);
        Schema::connection('mysql')->create('list_lesson', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->boolean('released')->default(true);
            $table->string('category')->default('');
            $table->string('name')->default('');
            $table->string('description')->default('');

            $table->engine = 'InnoDB';
        });
        DB::connection('mysql')->table('list_lesson')->insert([
            [
                "released"=> true,
                "category"=> "ReactJS Basic 1",
                "name"=>"English",
                "description"=>"description1"
            ],
            [
                "released"=> true,
                "category"=> "ReactJS Basic 2",
                "name"=>"ReactJS",
                "description"=>"description2"
            ],
            [
                "released"=> true,
                "category"=> "ReactJS Basic 3",
                "name"=>"ReactJS",
                "description"=>"description3"
            ],
            [
                "released"=> true,
                "category"=> "ReactJS Basic 4",
                "name"=>"ReactJS",
                "description"=>"description4"
            ],
            [
                "released"=> true,
                "category"=> "ReactJS Basic 5",
                "name"=>"English",
                "description"=>"description5"
            ],
            [
                "released"=> true,
                "category"=> "ReactJS Basic 6",
                "name"=>"English",
                "description"=>"description6"
            ]
        ]);
        Schema::connection('mysql')->create('questions', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('answers_id')->unsigned();
            $table->string('question')->default('');
            $table->string('category')->default('');  
            $table->timestamps();
            $table->foreign('answers_id')->references('id')->on('answer');;
            $table->engine = 'InnoDB';
        });
        DB::connection('mysql')->table('questions')->insert([
            [
                "question"=> "9+1=?",
                "category"=> "JavaScript Basic",
                "answers_id"=>1
            ],
            [
                "question"=> "9+2=?",
                "category"=> "JavaScript Basic",
                "answers_id"=>1
            ],
            [
                "question"=> "9+33=?",
                "category"=> "JavaScript Basic",
                "answers_id"=>1
            ],
            [
                "question"=> "9+4=?",
                "category"=> "JavaScript Basic",
                "answers_id"=>2
            ],
            [
                "question"=> "9+4=?",
                "category"=> "JavaScript",
                "answers_id"=>2
            ],
            [
                "question"=> "9+5=?",
                "category"=> "English",
                "answers_id"=>2
            ]
        ]);

        Schema::connection('mysql')-> create('category', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->string('name')->default('');
           
            $table->engine = 'InnoDB';
        });
        DB::connection('mysql')->table('category')->insert([
            [
                "name"=> "JavaScript",
            ],
            [
                "name"=> "ReactJS",
            ],
            [
                "name"=> "English",
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::connection('mysql')->dropIfExists('category');
        Schema::connection('mysql')->dropIfExists('answer');
        Schema::connection('mysql')->dropIfExists('list_lesson');
        Schema::connection('mysql')->dropIfExists('questions');
    }
}
