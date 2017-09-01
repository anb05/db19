<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appendix
 *
 * @package Db19\ModelsDb
 * @property int $id
 * @property int $document_id
 * @property mixed $appendix
 * @property-read \Db19\ModelsDb\Document $document
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Appendix whereAppendix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Appendix whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Appendix whereId($value)
 * @mixin \Eloquent
 * @property string|null $original_name
 * @property string|null $mime_type
 * @property int $size
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Appendix whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Appendix whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Appendix whereSize($value)
 */
class Appendix extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'appendices';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'appendix', 'original_name', 'mime_type', 'size'];

    public $timestamps = false;

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
