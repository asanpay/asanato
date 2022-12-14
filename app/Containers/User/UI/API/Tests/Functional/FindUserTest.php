<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\ApiTestCase;

/**
 * Class FindUsersTest.
 *
 * @group user
 * @group api
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserTest extends ApiTestCase
{

    protected $endpoint = 'get@v1/users/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'search-users',
    ];

    /**
     * @test
     */
    public function testFindUser()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($admin->full_name, $responseContent->data->name);
    }

    /**
     * @test
     */
    public function testFindFilteredUserResponse()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->endpoint($this->endpoint . '?filter=email;name')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        // todo: to fix
        //        $this->assertEquals($admin->name, $responseContent->data->name);
        //        $this->assertEquals($admin->email, $responseContent->data->email);

        $this->assertNotContains('id', (array) $responseContent->data);
    }

    /**
     * @test
     */
    public function testFindUserWithRelation()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->endpoint($this->endpoint . '?include=roles')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($admin->email, $responseContent->data->email);

        $this->assertNotNull($responseContent->data->roles);
    }
}
