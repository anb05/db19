<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Correspondent
 *
 * @package Db19\ModelsDb
 */
class Correspondent extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'correspondents';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'shot_name'];

    /**
     * This method returns a collection of Document models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Document',
            'correspondent_id',
            'id'
        );
    }
}
