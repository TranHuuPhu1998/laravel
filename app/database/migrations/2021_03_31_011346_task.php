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

        Schema::create('ProjectManager', function (Blueprint $table) {
            $table->increments('id', true)->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('project_client')->default('');
            $table->string('project_name')->default('');
            $table->string('project_type')->default('');
            $table->json('members')->nullable();
            $table->string('project_status')->default('');
            $table->timestamp('date_start')->useCurrent();
            $table->timestamp('date_end')->useCurrent();
            $table->timestamps();
           
            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql')->table('users' , function(Blueprint $table){
            $table->foreign('users_id')->references('id')->on('ProjectManager');
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
        Schema::dropIfExists('ProjectManager');
    }
}
