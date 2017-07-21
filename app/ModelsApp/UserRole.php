<?php

namespace App\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ModelsApp\UserRole
 *
 * @property int $user_id
 * @property int $role_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\UserRole whereUserId($value)
 * @mixin \Eloquent
 */
class UserRole extends Model
{
    protected $fillable = ['user_id', 'role_id'];

    protected $table = 'user_roles';

    public $timestamps = false;
}
