<?php

namespace App\Containers\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationPermissionsSeeder_1
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------
        Apiato::call('Authorization@CreatePermissionTask', ['manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.']);
        Apiato::call('Authorization@CreatePermissionTask', ['create-admins', 'Create new Users (Admins) from the dashboard.']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-admins-access', 'Assign users to Roles.']);
        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', 'Access the admins dashboard.']);

        Apiato::call('Authorization@CreatePermissionTask', ['search-users', 'Find user']);
        Apiato::call('Authorization@CreatePermissionTask', ['read-users', 'Read user data']);
        Apiato::call('Authorization@CreatePermissionTask', ['update-users', 'Update user profile']);

        Apiato::call('Authorization@CreatePermissionTask', ['read-wallet', 'Read all wallets']);
        Apiato::call('Authorization@CreatePermissionTask', ['update-wallet', 'Read all wallets']);
        Apiato::call('Authorization@CreatePermissionTask', ['delete-wallet', 'Delete user wallet']);

        Apiato::call('Authorization@CreatePermissionTask', ['transfer-between-other-wallets', 'Transfer money between others wallets']);
        Apiato::call('Authorization@CreatePermissionTask', ['view-all-bank-accounts', 'View all bank accounts']);

    }
}
