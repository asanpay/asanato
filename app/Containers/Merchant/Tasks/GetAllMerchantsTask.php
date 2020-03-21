<?php

namespace App\Containers\Merchant\Tasks;

use App\Containers\Merchant\Data\Repositories\MerchantRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllMerchantsTask extends Task
{

    protected $repository;

    public function __construct(MerchantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
