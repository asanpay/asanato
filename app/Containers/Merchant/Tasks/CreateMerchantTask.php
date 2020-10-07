<?php

namespace App\Containers\Merchant\Tasks;

use App\Containers\Merchant\Data\Repositories\MerchantRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class CreateMerchantTask extends Task
{

    protected $repository;

    public function __construct(MerchantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            $data ['code'] = $data ['code'] ?? hash('sha256', uniqid().random_string(10));
            $data ['ip_access'] = is_array($data ['ip_access']) ? implode(',', $data ['ip_access']) : $data ['ip_access'];
            
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            XLog::exception($exception);
            throw new CreateResourceFailedException();
        }
    }
}
