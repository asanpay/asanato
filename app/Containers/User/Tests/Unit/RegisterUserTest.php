<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\Otp\Actions\SendOtpAction;
use App\Containers\Otp\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Tasks\GetLatestUnusedOtpTask;
use App\Containers\User\Actions\UserSignUpAction;
use App\Containers\User\Data\Transporters\UserSignUpTransporter;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class CreateUserTest.
 *
 * @group user
 * @group unit
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class RegisterUserTest extends TestCase
{

    /**
     * @test
     */
    public function testCreateUser()
    {
        $data = [
            'to'     => '09121201726',
            'reason' => OtpReason::SIGN_UP,
            'ip'     => '127.0.0.1',
        ];

        $transporter = new CreateOtpTokenTransporter($data);
        $action      = App::make(SendOtpAction::class);
        $action->run($transporter);

        $task = App::make(GetLatestUnusedOtpTask::class);
        $otp  = $task->run('9121201726', OtpReason::SIGN_UP, 'mobile');

        $data = [
            'mobile'     => '9121201726',
            'email'      => 'Aboozar@test.test',
            'password'   => 'so-secret',
            'first_name' => 'Aboozar',
            'last_name'  => 'Ghaffari',
            'token'      => $otp->token,
            'client_ip'  => '127.0.0.1',
        ];

        $transporter = new UserSignUpTransporter($data);
        $action      = App::make(UserSignUpAction::class);
        $login       = $action->run($transporter);

        // asset the returned object is an instance of the User
        $this->assertArrayHasKey('response_content', $login[0]);
        $this->assertArrayHasKey('access_token', $login[0]['response_content']);
    }
}
