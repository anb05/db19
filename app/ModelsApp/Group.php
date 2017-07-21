<?php

namespace App\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ModelsApp\Group
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Group whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 */
class Group extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
