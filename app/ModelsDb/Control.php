<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Control
 *
 * @package Db19\ModelsDb
 * @property int $id
 * @property string $control_number
 * @property string|null $check_time
 * @property string|null $executed_time
 * @property int $document_id
 * @property int $responsible_executor
 * @property-read \Db19\ModelsDb\Document $document
 * @property-read \Db19\ModelsDb\UserDb $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Control whereCheckTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Control whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Control whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Control whereExecutedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Control whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Control whereResponsibleExecutor($value)
 * @mixin \Eloquent
 */
class Control extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'controls';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'control_number',
        'check_time',
        'executed_time',
        'document_id',
        'responsible_executor',
    ];

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
