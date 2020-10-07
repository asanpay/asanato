<?php

namespace App\Containers\Merchant\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Merchant\Enum\FeeBy;
use App\Containers\Merchant\Enum\FeePolicy;

class TestMerchantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domain = 'merchant.yhn';

        $user = \App\Containers\User\Models\User::where('mobile', 9354885725)->first();

        $merchant = Merchant::create([
            'name'        => 'درگاه تست با ۴٪ سود',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-percent-1-merchant'),
            'status'      => true,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 4,
            'fee_by'     => FeeBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست با ۱٪ سود',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-percent-1-merchant-2'),
            'status'      => true,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 1,
            'fee_by'     => FeeBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۲',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-percent-1-customer'),
            'status'      => true,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 1,
            'fee_by'     => FeeBy::CUSTOMER,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۳',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-permanent-1-merchant'),
            'status'      => true,
            'fee_policy' => FeePolicy::PERMANENT,
            'fee_value'  => 1500,
            'fee_by'     => FeeBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۴',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-permanent-1-customer'),
            'status'      => true,
            'fee_policy' => FeePolicy::PERMANENT,
            'fee_value'  => 1500,
            'fee_by'     => FeeBy::CUSTOMER,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۵',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-turnover'),
            'status'      => true,
            'fee_policy' => FeePolicy::TURNOVER,
            'fee_value'  => 0,
            'fee_by'     => FeeBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۶',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-disabled'),
            'status'      => false,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 1.5,
            'fee_by'     => FeeBy::MERCHANT,
            'domain'      => $domain,
        ]);


        $domain = 'foo.yhn';

        $user = \App\Containers\User\Models\User::find(3);

        $merchant = Merchant::create([
            'name'        => 'درگاه کاربر شناسه ۳',
            'user_id'     => $user->id,
            'code'        => hash('sha256', uniqid()),
            'status'      => true,
            'fee_policy' => FeePolicy::TURNOVER,
            'fee_value'  => 0,
            'fee_by'     => FeeBy::NONE,
            'domain'      => $domain,
        ]);


        $domain = 'gholi.yhn';

        $user = \App\Containers\User\Models\User::find(4);

        $merchant = Merchant::create([
            'name'        => 'درگاه کاربر شناسه ۴',
            'user_id'     => $user->id,
            'code'        => hash('sha256', uniqid()),
            'status'      => true,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 1,
            'fee_by'     => FeeBy::CUSTOMER,
            'domain'      => $domain,
        ]);


        $domain = 'bar.yhn';

        $user = \App\Containers\User\Models\User::find(5);

        $merchant = Merchant::create([
            'name'        => 'درگاه کاربر شناسه ۵',
            'user_id'     => $user->id,
            'code'        => hash('sha256', uniqid()),
            'status'      => true,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 1.5,
            'fee_by'     => FeeBy::MERCHANT,
            'fee_max'    => 1000,
            'domain'      => $domain,
        ]);

        $domain = 'baz.yhn';

        $user = \App\Containers\User\Models\User::find(6);

        $merchant = Merchant::create([
            'name'        => 'درگاه کاربر شناسه ۶',
            'user_id'     => $user->id,
            'code'        => hash('sha256', uniqid()),
            'status'      => true,
            'fee_policy' => FeePolicy::PERCENT,
            'fee_value'  => 4,
            'fee_by'     => FeeBy::MERCHANT,
            'fee_max'    => 3000,
            'domain'      => $domain,
        ]);
    }
}
