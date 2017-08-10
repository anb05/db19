<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfidentialNumber
 *
 * @package Db19\ModelsDb
 */
class ConfidentialNumber extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'confidential_numbers';

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
