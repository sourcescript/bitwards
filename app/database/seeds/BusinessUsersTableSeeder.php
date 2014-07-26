<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BusinessUsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        foreach(range(1, 10) as $index)
		{
			BusinessUser::create([
                'username' => $faker->userName,
                'password' => Hash::make('secret'),
                'business_email' => $faker->safeEmail,
                'business_name' => $faker->company,
                'business_address' => $faker->address,
                'business_description' => $faker->paragraph(1),
                'image' => 'http://placehold.it/300x200',
                'business_type' => $faker->randomElement([
                    'food',
                    'store',
                    'merchandise'
                ])
			]);
		}
	}

}