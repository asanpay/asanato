<?php

namespace App\Containers\IdentityProof\Tasks;

use App\Containers\IdentityProof\Data\Repositories\IdentityProofRepository;
use App\Containers\IdentityProof\Enum\IdProofStatus;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateIdentityProofTask extends Task
{

    protected $repository;

    public function __construct(IdentityProofRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(User $user, int $type, $status = IdProofStatus::PENDING)
    {
        try {
            return $this->repository->addProof($user, $type, $status);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
