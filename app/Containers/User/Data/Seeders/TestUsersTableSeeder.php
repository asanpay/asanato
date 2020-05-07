<?php
namespace App\Containers\User\Data\Seeders;


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
        $users = factory(\App\Containers\User\Models\User::class, 20)->create()->each(function($u) {
            $u->assignRole('member');
        });
    }
}
