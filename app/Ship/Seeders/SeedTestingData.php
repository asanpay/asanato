<?php

namespace App\Ship\Seeders;

use App\Containers\Authentication\Data\Seeders\TestOauthClientSeeder;
use App\Containers\BankAccount\Data\Seeders\TestBankAccountsTableSeeder;
use App\Containers\Merchant\Data\Seeders\TestMerchantsTableSeeder;
use App\Containers\User\Data\Seeders\TestUsersTableSeeder;
use App\Containers\Wallet\Data\Seeders\TestMerchantWalletSeeder;
use App\Containers\Wallet\Data\Seeders\TestSharedWalletsTableSeeder;
use App\Containers\Wallet\Data\Seeders\TestWalletsTableSeeder;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class SeedTestingData
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
        $this->call(TestUsersTableSeeder::class);
        $this->call(TestBankAccountsTableSeeder::class);
        $this->call(TestMerchantsTableSeeder::class);
        $this->call(TestWalletsTableSeeder::class);
        $this->call(TestMerchantWalletSeeder::class);
        $this->call(TestSharedWalletsTableSeeder::class);
    }
}
