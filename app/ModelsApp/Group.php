<?php

namespace Db19\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsApp\Group
 *
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Group whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsApp\Group whereName($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'name';

    protected $fillable = ['name', 'description'];

    public function users()
    {
        $this->hasMany(
            'Db19\User',
            'group_name',
            'name'
        );
    }
}
