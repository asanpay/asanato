<?php

namespace App\Containers\Helpdesk\Tasks;

use App\Containers\Helpdesk\Data\Repositories\HelpdeskRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllHelpdesksTask extends Task
{

    protected $repository;

    public function __construct(HelpdeskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
