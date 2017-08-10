<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 *
 * @package Db19\ModelsDb
 */
class Group extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'groups';

    protected $primaryKey = 'name';

    protected $fillable = ['name', 'description'];

    public $incrementing = false;

    /**
     * This method returns a collection of Document models
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(
            '\Db19\ModelsDb\Document',
            'document_group',
            'group_name',
            'document_id'
        );
    }
}
