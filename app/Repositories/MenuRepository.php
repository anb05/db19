<?php
/**
 */

namespace Db19\Repositories;

use Db19\ModelsApp\Privilege;
use Db19\ModelsApp\Role;

/**
 * Class MenuRepository
 *
 * @package Db19\Repositories
 */
class MenuRepository extends Repository
{
    /**
     * Repository constructor.
     *
     * @param Privilege $privilege
     *
     * @internal param Model $model
     */
    public function __construct(Privilege $privilege)
    {
        parent::__construct($privilege);
    }

    public function get()
    {
        $privilege = $this->getPrivilege();
    }

    /**
     * Для получения списка всех привилегий в виде массива необходимо вначале получить роль пользователя.
     * Зная роль пользователя получаем коллекцию объектов Privilege  и приобразовываем её в массив.
     * @return array
     */
    private function getPrivilege() : array
    {
        $role_name = \Auth::user()->role_name;
        $privileges = Role::find($role_name)->privileges;
        $vars = [];
        $privileges->transform(function ($item, $key) use (&$vars) {
            $vars[] = $item->name;
        });

        return $vars;
    }
}
