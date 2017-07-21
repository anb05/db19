<?php

namespace App\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ModelsApp\Role
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ModelsApp\Privilege[] $privileges
 */
class Role extends Model
{
    protected $fillable = ['id', 'name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function privileges()
    {
        return $this->hasMany('App\ModelsApp\Privilege');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles', 'role_id', 'user_id');
    }
}
