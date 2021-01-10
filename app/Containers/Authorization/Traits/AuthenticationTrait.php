<?php

namespace App\Containers\Authorization\Traits;

/**
 * Class AuthenticationTrait
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
trait AuthenticationTrait
{

    /**
     * Allows Passport to authenticate users with custom fields.
     *
     * @param $identifier
     *
     * @return AuthenticationTrait
     */
    public function findForPassport($identifier)
    {
        $allowedLoginAttributes = config('authentication-container.login.attributes', ['email' => []]);

        $builder = $this;
        foreach (array_keys($allowedLoginAttributes) as $field) {
            $builder = $builder->orWhere($field, $identifier);
        }

        return $builder->first();
    }
}
