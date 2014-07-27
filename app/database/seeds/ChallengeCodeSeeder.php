<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ChallengeCodeSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            foreach(range(1, 10) as $k)
            {
                DB::table('challenge_code')->insert([
                    'challenge_id' => $index,
                    'code' => $faker->word(1),
                    'used' => false
                ]);
            }
        }
    }

}