<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsDb\UserDb
 *
 * @mixin \Eloquent
 */
class UserDb extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'users';

    protected $fillable = ['id', 'name'];

    public $timestamps = false;

    /**
     * This method returns a collection of Control models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function controls()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Control',
            'responsible_executor',
            'id'
        );
    }

    /**
     * This method returns a collection of Resolution models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resolutions()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Resolution',
            'human_id',
            'id'
        );
    }
}
