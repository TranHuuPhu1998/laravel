<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Task extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->string('title')->default('');
            $table->string('description')->default('');
            $table->string('content')->default('');
            $table->integer('status')->default();
            $table->timestamp('created')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->engine = 'InnoDB';
        });

        DB::connection('mysql')->table('task')->insert([
            [
                "title"=> "Memo Title ",
                "description"=> "react reacdux",
                "content" => "Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.",
                "status"=> 1,
            ],
            [
                
                "title"=> "PlayGame",
                "description"=> "liên quan",
                "content" => "Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.",
                "status"=> 1,
            ],
            [
                "title"=> "Highcharts Demo",
                "description"=> "react reacdux",
                "content" => "Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.",
                "status"=> 2,
            ],
            [
                "title"=> "Memo Title ",
                "description"=> "react reacdux",
                "content" => "Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.",
                "status"=> 0,
            ],
            [
                "title"=> "post 1aaaa",
                "description"=> "ádfhh",
                "content" => "Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.",
                "status"=> 0,
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
        Schema::dropIfExists('task');
    }
}
