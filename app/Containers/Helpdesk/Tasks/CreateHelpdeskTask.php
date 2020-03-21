<?php

namespace App\Containers\Helpdesk\Tasks;

use App\Containers\Helpdesk\Data\Repositories\HelpdeskRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateHelpdeskTask extends Task
{

    protected $repository;

    public function __construct(HelpdeskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
