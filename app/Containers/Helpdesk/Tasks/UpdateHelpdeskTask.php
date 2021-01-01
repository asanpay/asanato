<?php

namespace App\Containers\Helpdesk\Tasks;

use App\Containers\Helpdesk\Data\Repositories\HelpdeskRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateHelpdeskTask extends Task
{

    protected $repository;

    public function __construct(HelpdeskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
