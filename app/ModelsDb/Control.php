<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Control
 *
 * @package Db19\ModelsDb
 */
class Control extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'controls';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'control_number', 'check_time', 'document_id', 'responsible_executor'];

    /**
     * This method returns an object of class UserDb
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(
            '\Db19\ModelsDb\UserDb',
            'responsible_executor',
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
