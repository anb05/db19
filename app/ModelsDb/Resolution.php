<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resolution
 *
 * @package Db19\ModelsDb
 */
class Resolution extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'resolutions';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'human_id', 'resolution',];

    /**
     * This method returns an object of class UserDb
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\UserDb',
            'human_id',
            'id'
        );
    }

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
