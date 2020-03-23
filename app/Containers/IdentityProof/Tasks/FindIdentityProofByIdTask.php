<?php

namespace App\Containers\IdentityProof\Tasks;

use App\Containers\IdentityProof\Data\Repositories\IdentityProofRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindIdentityProofByIdTask extends Task
{

    protected $repository;

    public function __construct(IdentityProofRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
