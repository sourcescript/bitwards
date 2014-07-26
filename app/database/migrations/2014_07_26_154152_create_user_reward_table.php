<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserRewardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_reward', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->integer('reward_id');
            $table->string('code')->nullable();
            $table->integer('points');
            $table->boolean('claimed');
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
		Schema::drop('user_reward');
	}

}
