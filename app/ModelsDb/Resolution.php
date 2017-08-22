<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resolution
 *
 * @package Db19\ModelsDb
 * @property int $id
 * @property int $document_id
 * @property int $human_id
 * @property string $resolution
 * @property string $date
 * @property-read \Db19\ModelsDb\Document $document
 * @property-read \Db19\ModelsDb\UserDb $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Resolution whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Resolution whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Resolution whereHumanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Resolution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Resolution whereResolution($value)
 * @mixin \Eloquent
 */
class Resolution extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'resolutions';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'human_id', 'resolution', 'date'];

    public $timestamps = false;

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
