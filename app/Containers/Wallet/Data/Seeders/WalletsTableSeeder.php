<?php
namespace App\Containers\Wallet\Data\Seeders;

use App\Containers\Wallet\Enum\WalletStatus;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Containers\User\Models\User;
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
        $user = User::where('mobile', 9354885725)->first();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_A',
            'type'        => WalletType::USER,
            'default'     => true
        ]);
        $w->balance = 1000000;
        $w->save();

        Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_B',
            'type'        => WalletType::USER,
        ]);

        $w->balance = 10000;
        $w->save();

        Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_LOCKED',
            'type'        => WalletType::USER,
            'status'      => WalletStatus::LOCKED
        ]);

        $w->balance = 500000;
        $w->save();


        // SYSTEM wallets ------------------------------
        Wallet::create([
            'id'      => 1,
            'user_id' => 1,
            'name'    => 'SYSTEM_INCOMING_MONEY',
            'type'    => WalletType::INCOMING_MONEY,
            'belongs_to_app' => true
        ]);

        Wallet::create([
            'id'      => 2,
            'user_id' => 1,
            'name'    => 'SYSTEM_OUTGOING_MONEY',
            'type'    => WalletType::OUTGOING_MONEY,
            'belongs_to_app' => true
        ]);

        Wallet::create([
            'id'      => 3,
            'user_id' => 1,
            'name'    => 'SYSTEM_TRANSACTION_PROFIT',
            'type'    => WalletType::TRANSACTION_PROFIT,
            'belongs_to_app' => true
        ]);

        Wallet::create([
            'id'      => 4,
            'user_id' => 1,
            'name'    => 'SYSTEM_TRANSFER_PROFIT',
            'type'    => WalletType::TRANSFER_PROFIT,
            'belongs_to_app' => true
        ]);

        Wallet::create([
            'id'      => 5,
            'user_id' => 1,
            'name'    => 'SYSTEM_WALLET_COST_PROFIT',
            'type'    => WalletType::WALLET_COST_PROFIT,
            'belongs_to_app' => true
        ]);

        Wallet::create([
            'id'      => 6,
            'user_id' => 1,
            'name'    => 'SYSTEM_WITHDRAW_PROFIT',
            'type'    => WalletType::WITHDRAW_PROFIT,
            'belongs_to_app' => true
        ]);

        // GATEWAYs wallets ------------------------------
        Wallet::create([
            'id'      => 101,
            'user_id' => 1, // hard code ID for site admin
            'name'    => "والت درگاه آسان پی",
            'type'    => WalletType::GATEWAY,
            'belongs_to_app' => true,
        ]);

        Wallet::create([
            'id'      => 102,
            'user_id' => 1, // hard code ID for site admin
            'name'    => "والت درگاه سامان",
            'type'    => WalletType::GATEWAY,
            'belongs_to_app' => true,
        ]);

        Wallet::create([
            'id'      => 103,
            'user_id' => 1, // hard code ID for site admin
            'name'    => "والت درگاه پارسیان",
            'type'    => WalletType::GATEWAY,
            'belongs_to_app' => true,
        ]);
    }
}
