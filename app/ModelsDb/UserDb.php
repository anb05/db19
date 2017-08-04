<?php

namespace Db19\ModelsDb;

use Illuminate\Database\Eloquent\Model;

/**
 * Db19\ModelsDb\UserDb
 *
 * @mixin \Eloquent
 */
class UserDb extends Model
{
    protected $connection = 'mysql_input_doc';

    protected $table = 'users';

    protected $fillable = ['id', 'name'];
}
