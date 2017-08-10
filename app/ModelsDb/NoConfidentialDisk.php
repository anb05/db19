<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NoConfidentialDisk
 *
 * @package Db19\ModelsDb
 */
class NoConfidentialDisk extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'no_confidential_disks';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'document_id', 'created_at', 'num'];
}
