<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		

       Schema::create('users', function($t) {
                $t->increments('id');
                $t->string('firstname', 60);
                $t->string('lastname', 65);
                $t->string('username', 16);
                $t->string('password', 64);
                $t->string('email', 100);
                $t->string('activation_code',50);
                $t->integer('activated')->unsigned();
                $t->integer('banned')->unsigned();
                $t->integer('profile_id')->unsigned();
                $t->timestamps();
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::drop('users');
	}

}