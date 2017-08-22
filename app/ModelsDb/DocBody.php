<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocBody
 *
 * @package Db19\ModelsDb
 * @property int $id
 * @property int $document_id
 * @property mixed $appendix
 * @property-read \Db19\ModelsDb\Document $document
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\DocBody whereAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\DocBody whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\DocBody whereId($value)
 * @mixin \Eloquent
 */
class DocBody extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'doc_bodies';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'appendix'];

    public $timestamps = false;

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
