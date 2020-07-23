<?php
namespace App\Containers\Wallet\Data\Seeders;

use App\Containers\Wallet\Enum\WalletStatus;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;

class TestWalletsTableSeeder extends Seeder
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
            'default'     => true,
        ]);
        $w->balance = 10000000;
        $w->save();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_B',
            'type'        => WalletType::USER,
        ]);

        $w->balance = 100000;
        $w->save();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_LOCKED',
            'type'        => WalletType::USER,
            'locked'      => true,
        ]);

        $w->balance = 5000000;
        $w->save();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_LOCKED_BAL',
            'type'        => WalletType::USER,
        ]);

        $w->balance = 1500000;
        $w->locked_balance = 1000000;
        $w->save();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_X_U2',
            'type'        => WalletType::USER,
        ]);

        $w->save();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_Y_U2',
            'type'        => WalletType::USER,
        ]);

        $w->save();

        $w = Wallet::create([
            'user_id'     => $user->id,
            'name'        => 'WALLET_Z_U2',
            'type'        => WalletType::USER,
        ]);

        $w->save();

    }
}
