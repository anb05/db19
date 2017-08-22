<?php
/**
 */

namespace Db19\Repositories;

use Db19\ModelsApp\Type;
use Illuminate\Database\Eloquent\Model;

class AsideRepository extends Repository
{
    public function __construct(Type $type)
    {
        parent::__construct($type);
    }

    public function getAllType()
    {
        return $this->model->pluck('name');
    }
}
