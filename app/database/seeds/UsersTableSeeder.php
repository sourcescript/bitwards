<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			SourceScript\V1\User\UserEloquentModel::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email_address' => $faker->safeEmail,
                'fb_id' => $faker->randomDigit
			]);
		}
	}

}