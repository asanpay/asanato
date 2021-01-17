<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\ApiTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class ProxyLoginTest
 *
 * @group authorization
 * @group api
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class ProxyLoginTest extends ApiTestCase
{

    protected $endpoint; // testing multiple endpoints form the tests

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    private $testingFilesCreated = false;

    private function prepareWebAdminProxyLogin($data, $request)
    {
        $endpoint = 'post@v1/clients/web/admin/signin';

        $user = $this->getTestingUser($data);
        $this->actingAs($user, 'web');

        $clientId     = '100';
        $clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create client
        DB::table('oauth_clients')->insert(
            [
                [
                    'id'                     => $clientId,
                    'secret'                 => $clientSecret,
                    'name'                   => 'Testing',
                    'redirect'               => 'http://localhost',
                    'password_client'        => '1',
                    'personal_access_client' => '0',
                    'revoked'                => '0',
                ],
            ]
        );

        // make the clients credentials available as env variables
        Config::set('authentication-container.clients.web.admin.id', $clientId);
        Config::set('authentication-container.clients.web.admin.secret', $clientSecret);

        // create testing oauth keys files
        $publicFilePath  = $this->createTestingKey('oauth-public.key');
        $privateFilePath = $this->createTestingKey('oauth-private.key');

        $response = $this->endpoint($endpoint)->makeCall($request);

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
        }

        return $response;
    }

    /**
     * @test
     */
    public function testClientWebAdminProxyLogin()
    {
        // create data to be used for creating the testing user and to be sent with the post request
        $data = [
            'email'    => 'testing@mail.com',
            'mobile'   => '9101234567',
            'password' => 'testingpass',
        ];

        $response = $this->prepareWebAdminProxyLogin($data, $data);

        $response->assertStatus(200);

        $response->assertCookie('refreshToken');

        $this->assertResponseContainKeyValue(
            [
            'token_type' => 'Bearer',
            ]
        );

        $this->assertResponseContainKeys(['expires_in', 'access_token']);
    }

    /**
     * @test
     */
    public function testLoginWithDeviceAttribute()
    {
        // create data to be used for creating the testing user and to be sent with the post request
        $data = [
            'mobile'     => '9101234567',
            'email'      => 'testing@mail.com',
            'password'   => 'testingpass',
            'first_name' => 'username',
        ];

        $request = [
            'password' => 'testingpass',
            'device'   => 'My Fancy Device',
        ];

        $response = $this->prepareWebAdminProxyLogin($data, $request);

        // we test for HTTP 422 because the user is not allowed to login via device attribute
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function testClientWebAdminProxyUnconfirmedLogin()
    {
        // create data to be used for creating the testing user and to be sent with the post request
        $data = [
            'mobile'   => '9101234567',
            'email'    => 'testing2@mail.com',
            'password' => 'testingpass',
        ];

        $response = $this->prepareWebAdminProxyLogin($data, $data);

        if (Config::get('authentication-container.require_email_confirmation')) {
            $response->assertStatus(409);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * @param $fileName
     *
     * @return string
     */
    private function createTestingKey($fileName)
    {
        $filePath = storage_path($fileName);

        if (!file_exists($filePath)) {
            $keysStubDirectory = __DIR__ . '/Stubs/';

            copy($keysStubDirectory . $fileName, $filePath);

            $this->testingFilesCreated = true;
        }

        return $filePath;
    }
}
