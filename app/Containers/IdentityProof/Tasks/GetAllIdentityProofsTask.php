<?php

namespace App\Containers\IdentityProof\Tasks;

use App\Containers\IdentityProof\Data\Repositories\IdentityProofRepository;
use App\Containers\IdentityProof\Data\Transporters\SearchInIdProofsTransporter;
use App\Ship\Parents\Tasks\Task;

class GetAllIdentityProofsTask extends Task
{

    protected $repository;

    public function __construct(IdentityProofRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(SearchInIdProofsTransporter $dto)
    {
        $criteria = [];
        if ($dto->user_id) {
            $criteria ['user_id'] = $dto->user_id;
        }
        if ($dto->type) {
            $criteria ['proof_type'] = $dto->type;
        }
        if ($dto->status) {
            $criteria ['status'] = $dto->status;
        }

        if (!empty($criteria)) {
            $repo = $this->repository->makeModel()->where($criteria);
        } else {
            $repo = $this->repository;
        }

        if ($dto->sort_by) {
            $repo->orderBy($dto->sort_by, $dto->sort_dir);
        }

        return $repo->paginate();
    }
}
