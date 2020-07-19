<?php

namespace App\Containers\Merchant\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Wallet\Enum\WageBy;
use App\Containers\Wallet\Enum\WagePolicy;

class MerchantsTableSeeder extends Seeder
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
            'wage_policy' => WagePolicy::PERCENT,
            'wage_value'  => 4,
            'wage_by'     => WageBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست با ۱٪ سود',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-percent-1-merchant-2'),
            'status'      => true,
            'wage_policy' => WagePolicy::PERCENT,
            'wage_value'  => 1,
            'wage_by'     => WageBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۲',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-percent-1-customer'),
            'status'      => true,
            'wage_policy' => WagePolicy::PERCENT,
            'wage_value'  => 1,
            'wage_by'     => WageBy::CUSTOMER,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۳',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-permanent-1-merchant'),
            'status'      => true,
            'wage_policy' => WagePolicy::PERMANENT,
            'wage_value'  => 1500,
            'wage_by'     => WageBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۴',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-permanent-1-customer'),
            'status'      => true,
            'wage_policy' => WagePolicy::PERMANENT,
            'wage_value'  => 1500,
            'wage_by'     => WageBy::CUSTOMER,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۵',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-turnover'),
            'status'      => true,
            'wage_policy' => WagePolicy::TURNOVER,
            'wage_value'  => 0,
            'wage_by'     => WageBy::MERCHANT,
            'domain'      => $domain,
        ]);

        $merchant = Merchant::create([
            'name'        => 'درگاه تست ۶',
            'user_id'     => $user->id,
            'code'        => hash('sha256', 'test-merchant-disabled'),
            'status'      => false,
            'wage_policy' => WagePolicy::PERCENT,
            'wage_value'  => 1.5,
            'wage_by'     => WageBy::MERCHANT,
            'domain'      => $domain,
        ]);
    }
}
