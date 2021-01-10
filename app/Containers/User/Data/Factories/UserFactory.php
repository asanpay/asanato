<?php

namespace App\Containers\User\Data\Factories;

use App\Containers\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Containers\User\Enum\UserGender;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName,
            'group'        => \App\Containers\User\Enum\UserGroup::NORMAL,
            'type'         => \App\Containers\User\Enum\UserType::PERSONAL,
            'register_via' => 'site',
            'email'        => $this->faker->unique()->safeEmail,
            'mobile'       => '912' . mt_rand(1111111, 9999999),
            'gender'       => $this->faker->randomElement([UserGender::MALE, UserGender::FEMALE]),
            'password'     => bcrypt('secret78'),
            'meta'         => json_encode(['telegram_id' => $this->faker->word]),
            'register_ip'  => $this->faker->ipv4,
            'api_key'      => hash('sha256', uniqid()),
            'is_client'    => true,
            config('google2fa.otp_secret_column') => \Google2FA::generateSecretKey(
                config('google2fa.key.size', 25),
                config('google2fa.key.prefix', '')
            )
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            //
        })->afterCreating(function (User $user) {
            $user->assignRole('member');
        });
    }
}
