<?php

namespace Db19\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsApp\Privilege
 *
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Privilege whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Privilege whereName($value)
 * @mixin \Eloquent
 */
class Privilege extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'name';

    protected $fillable = ['name', 'description'];

    public function roles()
    {
        $this->belongsToMany(
            'Db19\ModelsApp\Role',
            'privilege_role',
            'privilege_name',
            'role_name'
        );
    }
}
