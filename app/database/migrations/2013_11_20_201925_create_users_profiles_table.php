<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
   Schema::create('users_profiles', function($t) {
                $t->integer('user_id')->unsigned();
                $t->integer('profile_id')->unsigned();

	 });
   }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::drop('users_profiles');
	}

}