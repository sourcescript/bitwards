<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use SourceScript\V1\Rewards\RewardsEloquentModel;

class RewardsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			RewardsEloquentModel::create([
                'business_id' => $faker->randomElement(range(0, 9)),
                'name' => $faker->word(4),
                'point' => $faker->randomElement(range(1,10)),
                'description' => $faker->paragraph(4)
			]);
		}
	}

}