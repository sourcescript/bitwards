<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ChallengesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			SourceScript\V1\Challenges\ChallengesEloquentModel::create([
                'business_id' => 1,
                'name' => $faker->word(2),
                'description' => $faker->paragraph(1),
                'image' => 'http://placehold.it/200x200',
                'point' => $faker->randomElement(range(1,10)),
                'type' => $faker->randomElement([
                    'manual',
                    'social',
                    'image'
                ])
			]);
		}
	}

}