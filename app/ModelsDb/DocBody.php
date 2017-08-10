<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocBody
 *
 * @package Db19\ModelsDb
 */
class DocBody extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'doc_bodies';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'appendix'];

    /**
     * This method returns an object of class Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\Document',
            'document_id',
            'id'
        );
    }
}
