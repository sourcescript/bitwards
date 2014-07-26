<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_users', function($table){
			$table->increments('id');
			$table->string('username', 255);
			$table->string('password', 255);
			$table->string('business_email', 255);
			$table->string('business_name', 255);
			$table->string('business_address', 255);
			$table->string('business_description', 255);
			$table->string('business_type', 255);			
			$table->timestamps();


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
