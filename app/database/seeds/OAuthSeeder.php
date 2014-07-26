<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Carbon\Carbon;

class OAuthSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

            DB::table('oauth_clients')->insert([
                'id' => 'bitwards',
                'name' => 'bitwards',
                'secret' => 'bitwardssecret',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('oauth_scopes')->insert([
                'scope' => 'user',
                'name' => 'User',
                'description' => 'description',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('oauth_grants')->insert([
                'grant' => 'facebook',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('oauth_client_scopes')->insert([
                'client_id' => 'bitwards',
                'scope_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('oauth_client_grants')->insert([
                'client_id' => 'bitwards',
                'grant_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);


    }

}