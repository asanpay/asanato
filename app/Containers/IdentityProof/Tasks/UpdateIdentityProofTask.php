<?php

namespace App\Containers\IdentityProof\Tasks;

use App\Containers\IdentityProof\Data\Repositories\IdentityProofRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateIdentityProofTask extends Task
{

    protected $repository;

    public function __construct(IdentityProofRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
