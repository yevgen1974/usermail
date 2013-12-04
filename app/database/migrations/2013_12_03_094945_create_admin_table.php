<?php

use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

     
       Schema::create('admins', function($t) {
                $t->increments('id');
                $t->string('firstname', 60);
                $t->string('lastname', 65);
                $t->string('username', 16);
                $t->string('password', 64);
                $t->string('email', 100);
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
		 Schema::drop('admins');
	}

}