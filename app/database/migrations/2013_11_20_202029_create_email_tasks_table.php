<?php

use Illuminate\Database\Migrations\Migration;

class CreateEmailTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
       Schema::create('email_tasks', function($t) {
                $t->increments('id');
                $t->string('message',225);
                $t->text('email_template');
                $t->string('file_path', 225);
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
		 Schema::drop('email_tasks');
	}

}


