<?php
namespace App\Containers\User\Data\Seeders;

use App\Containers\User\Enum\UserGender;
use App\Containers\User\Enum\UserGroup;
use App\Containers\User\Enum\UserType;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(
            [
            'first_name'   => 'مدیر کل',
            'last_name'    => 'آسان پی',
            'group'        => UserGroup::NORMAL,
            'type'         => UserType::PERSONAL,
            'register_via' => 'site',
            'email'        => 'admin@asanpay.com',
            'mobile'       => '9123236908',
            'gender'       => UserGender::MALE,
            'password'     => bcrypt('secret78'),
            'meta'         => json_encode(['telegram_id' => 'a6oozar']),
            'register_ip'  => '127.0.0.1',
            'api_key'      => hash('sha256', uniqid()),
            'is_client'    => false,
            ]
        );
        $admin->assignRole('super-admin');

        $user = User::create(
            [
            'first_name'   => 'کاربر',
            'last_name'    => 'آسان پی',
            'group'        => UserGroup::NORMAL,
            'type'         => UserType::PERSONAL,
            'register_via' => 'site',
            'email'        => 'user@asanpay.com',
            'mobile'       => '9354885725',
            'gender'       => UserGender::MALE,
            'password'     => bcrypt('secret78'),
            'register_ip'  => '127.0.0.1',
            'api_key'     => hash('sha256', uniqid()),
            'is_client'    => true,
            ]
        );
        $user->assignRole('member');
    }
}
