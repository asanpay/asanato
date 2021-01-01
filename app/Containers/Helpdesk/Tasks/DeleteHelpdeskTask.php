<?php

namespace App\Containers\Helpdesk\Tasks;

use App\Containers\Helpdesk\Data\Repositories\HelpdeskRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteHelpdeskTask extends Task
{

    protected $repository;

    public function __construct(HelpdeskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
