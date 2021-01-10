<?php
namespace App\Containers\User\Data\Seeders;

use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;

class TestUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(20)
            ->create();
    }
}
