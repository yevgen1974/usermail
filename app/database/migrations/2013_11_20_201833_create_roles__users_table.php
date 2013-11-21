<?php

use Illuminate\Database\Migrations\Migration;

class CreateRolesUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		
   Schema::create('roles_users', function($t) {
                $t->integer('role_id')->unsigned();
                $t->integer('user_id')->unsigned();

    });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::drop('roles_users');
	}

}