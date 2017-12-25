<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsDb\UserDb
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Control[] $controls
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Document[] $documents
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Resolution[] $resolutions
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\UserDb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\UserDb whereName($value)
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

    public function documents()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Document',
            'creator_id',
            'id'
        );
    }
}
