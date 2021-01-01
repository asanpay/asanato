<?php

namespace App\Containers\BankAccount\Data\Seeders;

use App\Containers\Bank\Models\Bank;
use App\Containers\BankAccount\Enum\BankAccountStatus;
use App\Containers\BankAccount\Models\BankAccount;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;

class TestBankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user     = User::where('mobile', 9354885725)->first();
        $saman    = Bank::where('slug', 'saman')->first();
        $pasargad = Bank::where('slug', 'pasargad')->first();
        $mellat   = Bank::where('slug', 'mellat')->first();

        $a = BankAccount::create(
            [
            'user_id' => $user->id,
            'bank_id' => $saman->id,
            'iban'    => '650560088480002835963001',
            'ip'      => '127.0.0.1',
            'status'  => BankAccountStatus::APPROVED,
            'default' => true,
            ]
        );
        $a->save();


        $a = BankAccount::create(
            [
            'user_id' => $user->id,
            'bank_id' => $saman->id,
            'iban'    => '130560081188802835963001',
            'ip'      => '127.0.0.1',
            'status'  => BankAccountStatus::APPROVED,
            'default' => false,
            ]
        );
        $a->save();


        $a = BankAccount::create(
            [
            'user_id' => $user->id,
            'bank_id' => $pasargad->id,
            'iban'    => '650570034480000170034001',
            'ip'      => '127.0.0.1',
            'status'  => BankAccountStatus::APPROVED,
            'default' => false,
            ]
        );
        $a->save();


        $a = BankAccount::create(
            [
            'user_id' => $user->id,
            'bank_id' => $mellat->id,
            'iban'    => '400120000000005837569665',
            'ip'      => '127.0.0.1',
            'status'  => BankAccountStatus::APPROVED,
            'default' => false,
            ]
        );
        $a->save();
    }
}
