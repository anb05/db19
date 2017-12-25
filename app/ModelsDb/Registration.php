<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsDb\Registration
 *
 * @property int $id
 * @property int $document_id
 * @property string $num
 * @property string|null $date
 * @property string $type_name
 * @property-read \Db19\ModelsDb\Document $document
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Registration whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Registration whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Registration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Registration whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Registration whereTypeName($value)
 * @mixin \Eloquent
 */
class Registration extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'registrations';

    protected $primaryKey = 'id';

    protected $fillable =
        [
            'id',
            'document_id',
            'num',
            'date',
            'type_name',
        ];

    public $timestamps = false;

    public function document()
    {
        return $this->belongsTo(
            'Db19\ModelsDb\Document',
            'document_id',
            'id'
        );
    }
}
