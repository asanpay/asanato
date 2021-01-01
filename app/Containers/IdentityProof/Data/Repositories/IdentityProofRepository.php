<?php

namespace App\Containers\IdentityProof\Data\Repositories;

use App\Containers\IdentityProof\Enum\IdProofStatus;
use App\Containers\IdentityProof\Models\IdentityProof;
use App\Containers\User\Models\User;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class IdentityProofRepository
 */
class IdentityProofRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * @param User   $user
     * @param int    $type
     * @param string $status
     *
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function addProof(User $user, int $type, $status = IdProofStatus::PENDING)
    {
        $data = [
            'user_id'    => $user->id,
            'proof_type' => $type,
            'value'      => $user->getProofValue($type),
            'code'       => mt_rand(1000, 9999),
            'status'     => $status,
        ];

        return $this->create($data);
    }

    /**
     * @param User $user
     * @param int  $type
     *
     * @return bool
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getPendingProof(User $user, int $type): ?IdentityProof
    {
        return $this->makeModel()
            ->where('user_id', $user->id)
            ->where('proof_type', $type)
            ->where('value', $user->getProofValue($type))
            ->where('status', IdProofStatus::PENDING)
            ->orderBy('id', 'desc')
            ->first();
    }
}
