<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfidentialDisk
 *
 * @package Db19\ModelsDb
 */
class ConfidentialDisk extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'confidential_disks';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'created_at', 'num'];

    /**
     * This method returns an object of Document class
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
