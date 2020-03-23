<?php

namespace App\Containers\Authentication\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;

class TestOauthClientSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => 999,
            'name' => 'Test Oauth Client',
            'secret' => 'TEqZDfr0wiQDSg7abZOav5r0C9cnhHWO9Y1Ww15z',
            'redirect' => 'https://asanpay.com',
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        ]);

    }
}
