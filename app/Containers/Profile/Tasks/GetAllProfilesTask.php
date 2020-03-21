<?php

namespace App\Containers\Profile\Tasks;

use App\Containers\Profile\Data\Repositories\ProfileRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllProfilesTask extends Task
{

    protected $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
