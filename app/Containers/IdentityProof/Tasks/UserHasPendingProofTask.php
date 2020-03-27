<?php

namespace App\Containers\IdentityProof\Tasks;

use App\Containers\IdentityProof\Data\Repositories\IdentityProofRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UserHasPendingProofTask extends Task
{

    protected $repository;

    public function __construct(IdentityProofRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(User $user, string $type)
    {
        try {
            return $this->repository->hasPendingProof($user, $type);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
