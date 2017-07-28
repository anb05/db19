<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 27.07.17
 * Time: 18:29
 */

namespace Db19\Repositories;

use Db19\ModelsApp\Group;

class GroupRepository extends Repository
{
    public function __construct(Group $group)
    {
        parent::__construct($group);
    }
}
