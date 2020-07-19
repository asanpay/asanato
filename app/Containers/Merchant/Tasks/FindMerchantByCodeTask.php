<?php

namespace App\Containers\Merchant\Tasks;

use App\Containers\Merchant\Data\Repositories\MerchantRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindMerchantByApiKeyTask extends Task
{

    protected $repository;

    public function __construct(MerchantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $apiKey)
    {
        try {
            return $this->repository->findByField('code', $apiKey)->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
