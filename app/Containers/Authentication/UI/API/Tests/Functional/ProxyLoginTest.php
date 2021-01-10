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

    /**
     * @test
     */
    public function testClientWebAdminProxyLogin()
    {
        $endpoint = 'post@v1/clients/web/admin/signin';

        // create data to be used for creating the testing user and to be sent with the post request
        $data = [
            'email'    => 'testing@mail.com',
            'mobile'   => '9101234567',
            'password' => 'testingpass',
        ];

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

        $response = $this->endpoint($endpoint)->makeCall($data);

        $response->assertStatus(200);

        $response->assertCookie('refreshToken');

        $this->assertResponseContainKeyValue(
            [
            'token_type' => 'Bearer',
            ]
        );

        $this->assertResponseContainKeys(['expires_in', 'access_token']);

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
        }
    }

    /**
     * @test
     */
    public function testLoginWithDeviceAttribute()
    {
        $endpoint = 'post@v1/clients/web/admin/signin';

        // create data to be used for creating the testing user and to be sent with the post request
        $data = [
            'mobile'     => '9101234567',
            'email'      => 'testing@mail.com',
            'password'   => 'testingpass',
            'first_name' => 'username',
        ];

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

        $request = [
            'password' => 'testingpass',
            'device'   => 'My Fancy Device',
        ];

        $response = $this->endpoint($endpoint)->makeCall($request);

        // we test for HTTP 422 because the user is not allowed to login via device attribute
        $response->assertStatus(422);

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
        }
    }

    /**
     * @test
     */
    public function testClientWebAdminProxyUnconfirmedLogin()
    {
        $endpoint = 'post@v1/clients/web/admin/signin';

        // create data to be used for creating the testing user and to be sent with the post request
        $data = [
            'mobile'   => '9101234567',
            'email'    => 'testing2@mail.com',
            'password' => 'testingpass',
        ];

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

        $response = $this->endpoint($endpoint)->makeCall($data);

        if (Config::get('authentication-container.require_email_confirmation')) {
            $response->assertStatus(409);
        } else {
            $response->assertStatus(200);
        }

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
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
