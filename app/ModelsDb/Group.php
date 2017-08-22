<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 *
 * @package Db19\ModelsDb
 * @property string $name
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\Db19\ModelsDb\Document[] $documents
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Group whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Db19\ModelsDb\Group whereName($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'groups';

    protected $primaryKey = 'name';

    protected $fillable = ['name', 'description'];

    public $incrementing = false;

    public $timestamps = false;

    /**
     * This method returns a collection of Document models
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(
            '\Db19\ModelsDb\Document',
            'document_group',
            'group_name',
            'document_id'
        );
    }
}
