<?php

namespace App\Containers\Merchant\Tasks;

use App\Containers\Merchant\Data\Repositories\MerchantRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class FindMerchantByCodeTask extends Task
{

    protected $repository;

    public function __construct(MerchantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $code)
    {
        try {
            return $this->repository->findByField('code', $code)->first();
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new NotFoundException();
        }
    }
}
