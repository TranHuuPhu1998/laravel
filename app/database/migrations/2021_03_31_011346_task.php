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
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->engine = 'InnoDB';
        });

        Schema::create("taskItem" , function(Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('taskid')->unsigned();
            $table->string('taskname')->default('');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql')->table('taskItem', function (Blueprint $table) {
            $table->foreign('taskid')->references('id')->on('task');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taskItem');
        Schema::dropIfExists('task');
    }
}
