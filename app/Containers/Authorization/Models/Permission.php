<?php

namespace App\Containers\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Containers\Authorization\Data\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class Permission extends SpatiePermission
{

    use HashIdTrait;
    use HasResourceKeyTrait;
    use HasFactory;

    protected $guard_name = 'web';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PermissionFactory::new();
    }
}
