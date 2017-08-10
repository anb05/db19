<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NoConfidentialOutput
 *
 * @package Db19\ModelsDb
 */
class NoConfidentialOutput extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'no_confidential_output';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'num', 'created_at', 'document_id'];

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
