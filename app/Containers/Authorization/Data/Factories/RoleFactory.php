<?php

namespace App\Containers\Authorization\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Containers\Authorization\Models\Role;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->slug,
        ];
    }
}
