<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\Otp\Actions\SendOtpAction;
use App\Containers\Otp\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Tasks\GetLatestUnusedOtpTask;
use App\Containers\User\Tests\ApiTestCase;
use Illuminate\Support\Facades\App;

/**
 * Class RegisterUserTest.
 *
 * @group  user
 * @group  api
 *
 */
class RegisterUserTest extends ApiTestCase
{

    protected $endpoint = 'post@v1/signup';

    protected $auth = false;

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    /**
     * @test
     */
    //    public function testRegisterNewUserWithCredentials_()
    //    {
    //        $data = [
    //            'to'     => '09121201726',
    //            'reason' => OtpReason::SIGN_UP,
    //            'ip'     => '127.0.0.1',
    //        ];
    //
    //        $transporter = new CreateOtpTokenTransporter($data);
    //        $action      = App::make(SendOtpAction::class);
    //        $action->run($transporter);
    //
    //        $task = App::make(GetLatestUnusedOtpTask::class);
    //        $otp  = $task->run('9121201726', OtpReason::SIGN_UP, 'mobile');
    //
    //        $data = [
    //            'mobile'     => '9121201726',
    //            'email'      => 'apiato@mail.test',
    //            'first_name' => 'Apiato',
    //            'last_name'  => 'Apiato',
    //            'password'   => 'secretpass',
    //            'token'      => $otp->token,
    //            'ip'         => '127.0.0.1',
    //        ];
    //
    //        // send the HTTP request
    //        $response = $this->makeCall($data);
    //
    //        // assert response status is correct
    //        $response->assertStatus(200);
    //    }

    /**
     * @test
     */
    public function testRegisterNewUserUsingGetVerb()
    {
        $data = [
            'email'      => 'apiato@mail.test',
            'first_name' => 'Apiato',
            'last_name'  => 'Apiato',
            'mobile'     => '9121201726',
            'password'   => 'secretpass',
            'token'      => '1234',
            'ip'         => '127.0.0.1',
        ];

        // send the HTTP request
        $response = $this->endpoint('get@v1/signup')->makeCall($data);

        // assert response status is correct
        $response->assertStatus(405);

        $this->assertResponseContainKeyValue([
            'errors' => 'Method Not Allowed!',
        ]);
    }

    /**
     * @test
     */
    public function testRegisterExistingUser()
    {
        $userDetails = [
            'email'      => 'apiato@mail.test',
            'first_name' => 'Apiato',
            'last_name'  => 'Apiato',
            'mobile'     => '9121201726',
            'password'   => 'secretpass',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->getTestingUser($userDetails);

        $data = [
            'email'      => $userDetails['email'],
            'password'   => $userDetails['password'],
            'first_name' => $userDetails['first_name'],
            'last_name'  => $userDetails['last_name'],
            'mobile'     => $userDetails['mobile'],
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function testRegisterNewUserWithoutEmail()
    {
        $data = [
            'name'     => 'Apiato',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function testRegisterNewUserWithoutName()
    {
        $data = [
            'email'    => 'apiato@mail.test',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);
    }
}
