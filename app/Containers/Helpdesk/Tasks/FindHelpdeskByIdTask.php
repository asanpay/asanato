<?php

namespace App\Containers\Helpdesk\Tasks;

use App\Containers\Helpdesk\Data\Repositories\HelpdeskRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindHelpdeskByIdTask extends Task
{

    protected $repository;

    public function __construct(HelpdeskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
