<?php
namespace App\Containers\Wallet\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Containers\Wallet\Models\MerchantWallet;

class TestMerchantWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // merchant 1
        MerchantWallet::create([
            'merchant_id' => 1,
            'wallet_id'   => 1000111111,
            'share'       => 80,
        ]);

        MerchantWallet::create([
            'merchant_id' => 1,
            'wallet_id'   => 1000111112,
            'share'       => 20,
        ]);

        // merchant 2
        MerchantWallet::create([
            'merchant_id' => 2,
            'wallet_id'   => 1000111113,
            'share'       => 100,
        ]);


        // merchant 3
        MerchantWallet::create([
            'merchant_id' => 3,
            'wallet_id'   => 1000111113,
            'share'       => 1.5,
        ]);

        MerchantWallet::create([
            'merchant_id' => 3,
            'wallet_id'   => 1000111114,
            'share'       => 98.5,
        ]);


        // merchant 4
        MerchantWallet::create([
            'merchant_id' => 4,
            'wallet_id'   => 1000111115,
            'share'       => 20,
        ]);

        MerchantWallet::create([
            'merchant_id' => 4,
            'wallet_id'   => 1000111116,
            'share'       => 40,
        ]);

        MerchantWallet::create([
            'merchant_id' => 4,
            'wallet_id'   => 1000111117,
            'share'       => 40,
        ]);
    }
}
