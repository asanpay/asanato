<?php

namespace App\Ship\Seeders;

use App\Containers\Authentication\Data\Seeders\TestOauthClientSeeder;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class SeedTestingData
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SeedTestingData extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestOauthClientSeeder::class);
    }

}
