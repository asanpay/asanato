<?php

namespace App\Ship\Parents\Tasks;

use Apiato\Core\Abstracts\Tasks\Task as AbstractTask;
use App\Containers\User\Models\User;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;

/**
 * Class Task.
 */
abstract class Task extends AbstractTask
{
    /**
     * @return bool|string
     */
    public function weAreOnProduction()
    {
        return app()->environment('production');
    }

    public function pushCurrentUserCriteria(User $user)
    {
        $this->repository->pushCriteria(new ThisUserCriteria($user->id));
    }
}
