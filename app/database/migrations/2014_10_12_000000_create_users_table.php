<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id', true)->unsigned();
            $table->string('name');
            $table->integer('project_id')->unsigned();
            $table->string('email',191)->unique();
            $table->integer('permission');
            $table->integer('position');
            $table->string('password');
            $table->string('status')->default('');
            $table->boolean('isAdmin')->default(false);
            $table->rememberToken();
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
