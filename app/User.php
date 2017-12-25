<?php

namespace Db19;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Db19\User
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $group_id
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereGroupId($value)
 * @property \Carbon\Carbon|null $deleted_at
 * @method bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Db19\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Db19\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Db19\User withoutTrashed()
 * @property string $group_name
 * @property string $role_name
 * @property-read \Db19\ModelsApp\Group $group
 * @property-read \Db19\ModelsApp\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereRoleName($value)
 * @property string $full_name
 * @property int $attempt
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereAttempt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\User whereFullName($value)
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'name', 'email', 'password',
        'id','login', 'full_name', 'password', 'group_name', 'role_name', 'attempt',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(
            'Db19\ModelsApp\Group',
            'group_name',
            'name'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(
            'Db19\ModelsApp\Role',
            'role_name',
            'name'
        );
    }
}
