<?php

use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	

       Schema::create('profiles', function($t) {
                $t->increments('id');
                $t->string('phpotot_url',225);
                $t->string('title', 65);
                $t->string('gender', 12);
                $t->string('street', 125);
                $t->string('zip', 60);
                $t->string('state', 100);
                $t->string('phone', 100);
                $t->string('web', 120);
                $t->integer('user_id')->unsigned();
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
	
	 Schema::drop('profiles');

	}

}