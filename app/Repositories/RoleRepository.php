<?php
/**
 */

namespace Db19\Repositories;

use Db19\ModelsApp\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends Repository
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

}