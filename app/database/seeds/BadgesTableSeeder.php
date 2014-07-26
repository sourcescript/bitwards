<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use SourceScript\V1\Badges\BadgesEloquentModel;

class BadgesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			BadgesEloquentModel::create([
                'name' => $faker->name,
                'image' => 'http://placehold.it/100x100',
                'description' => $faker->paragraph(1),
                'requirement_type' => $faker->randomElement(['']),
                'requirement' => $faker->randomNumber()
			]);
		}
	}

}