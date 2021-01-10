<?php

namespace App\Containers\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Containers\Authorization\Data\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class Role extends SpatieRole
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
        'level',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
