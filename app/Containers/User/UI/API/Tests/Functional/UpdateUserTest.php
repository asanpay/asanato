<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\ApiTestCase;

/**
 * Class UpdateUserTest.
 *
 * @group user
 * @group api
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTest extends ApiTestCase
{

    protected $endpoint = 'put@v1/users/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'update-users',
    ];

    /**
     * @test
     */
    public function testUpdateExistingUser()
    {
        $user = $this->getTestingUser();

        $data = [
            'type'        => 'PERSONAL',
            'gender'      => 'MALE',
            'first_name'  => 'Updated Name',
            'last_name'   => 'Updated LName',
            'national_id' => 1234554321,
            'password'    => 'updated#Password',
            'email'       => $user->email,
            'mobile'      => 9121234567,
            'tel'         => '02112312312',
            'birth_date'  => '2020-06-10',
            'address'     => 'foo bar baz',
        ];

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned user is the updated one
        $this->assertResponseContainKeyValue(
            [
                'object'     => 'User',
                'email'      => $user->email,
                'first_name' => $data['first_name'],
            ]
        );

        // assert data was updated in the database
        $this->assertDatabaseHas('users', ['first_name' => $data['first_name']]);
    }

    /**
     * @test
     */
    public function testUpdateNonExistingUser()
    {
        $data = [
            'name' => 'Updated Name',
        ];

        $fakeUserId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeUserId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue(
            [
                'status' => 'error',
            ]
        );
    }

    /**
     * @test
     */
    public function testUpdateExistingUserWithoutData()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue(
            [
                'message' => 'The given data was invalid.',
            ]
        );
    }

    /**
     * @test
     */
    public function testUpdateExistingUserWithEmptyValues()
    {
        $data = [
            'type'        => '',
            'gender'      => '',
            'first_name'  => '',
            'last_name'   => '',
            'national_id' => '',
            'password'    => '',
            'email'       => '',
            'mobile'      => '',
            'tel'         => '',
            'birth_date'  => '',
            'address'     => '',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertValidationErrorContain(
            [
                // messages should be updated after modifying the validation rules, to pass this test
                'national_id' => 'The national id field is required.',
                'first_name'  => 'The first name field is required.',
            ]
        );
    }
}
