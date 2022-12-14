<?php

namespace App\Ship\Seeders;

use App\Containers\Authorization\Data\Seeders\AuthorizationPermissionsSeeder;
use App\Containers\Authorization\Data\Seeders\AuthorizationRolesSeeder;
use App\Containers\Bank\Data\Seeders\BanksTableSeeder;
use App\Containers\Bank\Data\Seeders\GatewaysTableSeeder;
use App\Containers\Bank\Data\Seeders\PspsTableSeeder;
use App\Containers\User\Data\Seeders\UsersTableSeeder;
use App\Containers\Wallet\Data\Seeders\WalletsTableSeeder;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class SeedDeploymentData
 */
class SeedDeploymentData extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // region
        $this->call(\CountriesTableSeeder::class);
        $this->call(\ProvincesTableSeeder::class);
        $this->call(\LocationsTableSeeder::class);

        // infrastructure
        $this->call(BanksTableSeeder::class);
        $this->call(PspsTableSeeder::class);

        $this->call(AuthorizationPermissionsSeeder::class);
        $this->call(AuthorizationRolesSeeder::class);

        $this->call(UsersTableSeeder::class);

        $this->call(WalletsTableSeeder::class);
        $this->call(GatewaysTableSeeder::class);
    }
}
