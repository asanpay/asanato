<?php

namespace App\Containers\IdentityProof\Tasks;

use App\Containers\IdentityProof\Data\Repositories\IdentityProofRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteIdentityProofTask extends Task
{

    protected $repository;

    public function __construct(IdentityProofRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
