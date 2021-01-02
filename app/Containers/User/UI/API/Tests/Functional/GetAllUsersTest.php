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
class GetAllUsersTest extends ApiTestCase
{

    protected $endpoint = 'get@v1/users';

    protected $access = [
        'roles'       => 'super-admin',
        'permissions' => 'read-users',
    ];

    /**
     * @test
     */
    public function testGetAllUsersByAdmin()
    {
        // create some non-admin users who are clients
        factory(User::class, 2)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(10, $responseContent->data);
    }

    /**
     * @test
     */
    public function testGetAllUsersByNonAdmin()
    {
        $this->getTestingUserWithoutAccess();

        // create some fake users
        factory(User::class, 2)->create();

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

    /**
     * @test
     */
    public function testSearchUsersByName()
    {
        $user = $this->getTestingUser(
            [
                'first_name' => 'abooozar',
                'last_name' => 'ghafffari',
            ]
        );

        // 3 random users
        factory(User::class, 3)->create();

        // send the HTTP request
        $response = $this->endpoint($this->endpoint. '?search=first_name:abooozar')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseArray = $response->decodeResponseJson();

        $this->assertEquals($user->full_name, $responseArray['data'][0]['name']);

        // assert only single user was returned
        $this->assertCount(1, $responseArray['data']);
    }
}
