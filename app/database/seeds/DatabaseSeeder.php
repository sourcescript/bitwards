<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('ChallengesTableSeeder');
        $this->call('OAuthSeeder');
        $this->call('BusinessUsersTableSeeder');
        $this->call('RewardsTableSeeder');
	}

}
