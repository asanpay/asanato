<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class FindUserByMobileTask
 *
 * @author Aboozar Ghaffari
 */
class FindUserByMobileTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $mobile
     *
     * @return User
     * @throws NotFoundException
     */
    public function run(string $mobile): ?User
    {
        try {
            $mobile = mobilify($mobile);
            return $this->repository->findByField('mobile', $mobile)->first();
        } catch (Exception $e) {
            throw new NotFoundException();
        }
    }
}
