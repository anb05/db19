<?php

namespace Db19\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsApp\Role
 *
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Role whereName($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'name';

    protected $fillable = ['name', 'description'];

    public function users()
    {
        $this->hasMany(
            'Db19\User',
            'role_name',
            'name'
        );
    }

    public function privileges()
    {
        $this->belongsToMany(
            'Db19\ModelsApp\Privilege',
            'privilege_role',
            'role_name',
            'privilege_name'
        );
    }
}
