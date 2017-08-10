<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeOfDocument
 *
 * @package Db19\ModelsDb
 */
class TypeOfDocument extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'types_of_documents';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'type'];

    /**
     * This method returns a collection of Document models
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(
            '\Db19\ModelsDb\Document',
            'type_id',
            'id'
        );
    }
}
