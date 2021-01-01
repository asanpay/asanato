<?php
namespace App\Containers\Wallet\Data\Seeders;

use App\Containers\Wallet\Enum\WalletStatus;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Seeders\Seeder;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SYSTEM wallets ------------------------------
        Wallet::create(
            [
            'id'      => 1,
            'user_id' => 1,
            'name'    => 'SYSTEM_INCOMING_MONEY',
            'type'    => WalletType::INCOMING_MONEY,
            'belongs_to_app' => true,
            ]
        );

        Wallet::create(
            [
            'id'      => 2,
            'user_id' => 1,
            'name'    => 'SYSTEM_OUTGOING_MONEY',
            'type'    => WalletType::OUTGOING_MONEY,
            'belongs_to_app' => true,
            ]
        );

        Wallet::create(
            [
            'id'      => 3,
            'user_id' => 1,
            'name'    => 'SYSTEM_PROFIT',
            'type'    => WalletType::PROFIT,
            'belongs_to_app' => true,
            ]
        );

        // GATEWAYs wallets ------------------------------
        Wallet::create(
            [
            'id'      => 101,
            'user_id' => 1, // hard code ID for site admin
            'name'    => "والت درگاه آسان پی",
            'type'    => WalletType::GATEWAY,
            'belongs_to_app' => true,
            ]
        );

        Wallet::create(
            [
            'id'      => 102,
            'user_id' => 1, // hard code ID for site admin
            'name'    => "والت درگاه سامان",
            'type'    => WalletType::GATEWAY,
            'belongs_to_app' => true,
            ]
        );

        Wallet::create(
            [
            'id'      => 103,
            'user_id' => 1, // hard code ID for site admin
            'name'    => "والت درگاه پارسیان",
            'type'    => WalletType::GATEWAY,
            'belongs_to_app' => true,
            ]
        );
    }
}
