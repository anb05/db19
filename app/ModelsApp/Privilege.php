<?php

namespace App\ModelsApp;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ModelsApp\Privilege
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $role_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Privilege whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Privilege whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Privilege whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Privilege whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Privilege whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ModelsApp\Privilege whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Privilege extends Model
{
    protected $fillable = ['id', 'name', 'description',];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\ModelsApp\Role');
    }
}
