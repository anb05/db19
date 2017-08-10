<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NoConfidentialInventory
 *
 * @package Db19\ModelsDb
 */
class NoConfidentialInventory extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'no_confidential_inventorys';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'full_inventory', 'document_id'];

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
