<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

/**
 * Class GetAllUsersTest.
 *
 * @group user
 * @group api
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAdminsTest extends ApiTestCase
{

    protected $endpoint = 'get@v1/admins';

    protected $access = [
        'roles'       => '',
        'permissions' => 'read-users',
    ];

    /**
     * @test
     */
    public function testGetAllAdmins()
    {
        // create some non-admin users
        User::factory()->count(2)->make();

        // should not be returned
        User::factory()->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(
            1,
            $responseContent->data
        ); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

    /**
     * @test
     */
    public function testGetAllAdminsByNonAdmin()
    {
        $this->getTestingUserWithoutAccess();

        // create some fake users
        User::factory()->count(2)->make();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(403);

        $this->assertResponseContainKeyValue(
            [
                'message' => 'This action is unauthorized.',
            ]
        );
    }
}
