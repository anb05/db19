<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appendix
 *
 * @package Db19\ModelsDb
 */
class Appendix extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'appendices';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'appendix'];

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
