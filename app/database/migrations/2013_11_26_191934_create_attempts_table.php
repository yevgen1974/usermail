<?php

use Illuminate\Database\Migrations\Migration;

class CreateAttemptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		    Schema::create('attemps', function($t) {
                $t->increments('id');
                $t->string('ip', 45);
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
		 Schema::drop('attempts');
	}

}