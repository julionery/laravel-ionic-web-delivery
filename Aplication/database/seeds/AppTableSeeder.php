<?php

use Illuminate\Database\Seeder;
use WebDelivery\Models\Oauth_client;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Oauth_client::class)->create([
            'id' => 'appid01',
            'secret' => 'secret',
            'name'=> 'MyApp',
        ]);

    }
}
