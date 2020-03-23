<?php

namespace App\Containers\User\Tasks;

use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\UserSignUpTransporter;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserByCredentialsTask
 * @package App\Containers\User\Tasks
 */
class CreateUserByCredentialsTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserSignUpTransporter $t
     *
     * @return User
     */
    public function run(UserSignUpTransporter $t): User
    {
        try {

            // create new user
            $user = $this->repository->create([
                'password'     => Hash::make($t->password),
                'mobile'       => $t->mobile,
                'first_name'   => $t->first_name,
                'last_name'    => $t->last_name,
                'register_ip'  => $t->client_ip,
                'register_via' => $t->device,
                'referrer'     => $t->referrer,
            ]);

            if ($t->should_verify_mobile == true) {
                $user->verify(IdPoofType::MOBILE);
            }
        } catch (Exception $e) {

            throw (new CreateResourceFailedException())->debug($e);
        }

        return $user;
    }

}
