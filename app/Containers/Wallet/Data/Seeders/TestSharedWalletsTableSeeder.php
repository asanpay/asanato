<?php

namespace App\Containers\Wallet\Data\Seeders;

use App\Containers\Wallet\Models\SharedWallet;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;

class TestSharedWalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('mobile', 9354885725)->first();

        $sharedWallet = new SharedWallet();

        $sharedWallet->user_id = $user->id;
        $sharedWallet->wallet_id = 1000111121; // user 5 wallet;
        $sharedWallet->accepted = true;
        $sharedWallet->save();


        $sharedWallet = new SharedWallet();

        $sharedWallet->user_id = $user->id;
        $sharedWallet->wallet_id = 1000111122; // user 6 wallet;
        $sharedWallet->accepted = true;
        $sharedWallet->save();


        $sharedWallet = new SharedWallet();

        $sharedWallet->user_id = $user->id;
        $sharedWallet->wallet_id = 1000111120; // user 4 wallet;
        $sharedWallet->accepted = false; // <--- not accepted
        $sharedWallet->save();
    }
}
