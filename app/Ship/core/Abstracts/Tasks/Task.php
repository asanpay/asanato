<?php

namespace Apiato\Core\Abstracts\Tasks;

use Apiato\Core\Traits\HasRequestCriteriaTrait;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class Task.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Task
{
    use HasRequestCriteriaTrait;
}
