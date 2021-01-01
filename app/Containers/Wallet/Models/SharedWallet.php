<?php

namespace App\Containers\Wallet\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Ship\Parents\Models\Model;

class SharedWallet extends Model
{
    protected $table = 'shared_wallets';
    protected $primaryKey = 'id';

    /**
     * only return the shared wallets that accepted by target account owner
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(
            'accepted',
            function (Builder $builder) {
                $builder->where('accepted', true);
            }
        );
    }
}
