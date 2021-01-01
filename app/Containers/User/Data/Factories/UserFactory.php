<?php

use App\Containers\User\Enum\UserGender;

$factory->define(
    \App\Containers\User\Models\User::class,
    function (Faker\Generator $faker) {
        static $password;

        return [
            'first_name'   => $faker->firstName,
            'last_name'    => $faker->lastName,
            'group'        => \App\Containers\User\Enum\UserGroup::NORMAL,
            'type'         => \App\Containers\User\Enum\UserType::PERSONAL,
            'register_via' => 'site',
            'email'        => $faker->unique()->safeEmail,
            'mobile'       => '912' . mt_rand(1111111, 9999999),
            'gender'       => $faker->randomElement([UserGender::MALE, UserGender::FEMALE]),
            'password'     => bcrypt('secret78'),
            'meta'         => json_encode(['telegram_id' => $faker->word]),
            'register_ip'  => $faker->ipv4,
            'api_key'      => hash('sha256', uniqid()),
            'is_client'    => true,
            config('google2fa.otp_secret_column') => \Google2FA::generateSecretKey(
                config('google2fa.key.size', 25),
                config('google2fa.key.prefix', '')
            )
        ];
    }
);
