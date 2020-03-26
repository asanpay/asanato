<?php

namespace App\Containers\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationRolesSeeder_2
 *
 */
class AuthorizationRolesSeeder_2 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles ----------------------------------------------------------------
        Apiato::call('Authorization@CreateRoleTask', ['super-admin', 'Administrator', 'Administrator Role', 999]);

        Apiato::call('Authorization@CreateRoleTask', ['manager', 'Manager', 'Member Role', 800]);

        Apiato::call('Authorization@CreateRoleTask', ['finance-manager', 'Finance Manager', 'Finance Member Role', 799]);
        Apiato::call('Authorization@CreateRoleTask', ['finance-operator', 'Finance Operator', 'Finance Operator Role', 700]);

        Apiato::call('Authorization@CreateRoleTask', ['support-manager', 'Support', 'Support Manager Role', 699]);
        Apiato::call('Authorization@CreateRoleTask', ['support-operator', 'Support Operator', 'Support Operator Role', 600]);

        $r = Apiato::call('Authorization@CreateRoleTask', ['member', 'Member', 'Member Role', 200]);
        //$r->givePermissionTo('update-users');

        // ...

    }
}
