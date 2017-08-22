<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * This class describe a states of documents when is created.
 *
 * @package Db19\ModelsDb
 * @property string $name
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Document[] $documents
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\State whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\State whereName($value)
 * @mixin \Eloquent
 */
class State extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'states';

    protected $primaryKey = 'name';

    protected $fillable = ['name', 'description',];

    public $incrementing = false;

    public $timestamps = false;

    /**
     * This method return a collection of documents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(
            'Db19\ModelsDb\Document',
            'state_name',
            'name'
        );
    }
}
