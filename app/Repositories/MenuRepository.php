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
        $privileges = $this->getPrivilege();
        $actions = $this->selectAction($privileges);
        $menu = view('common.main_menu', ['mainMenu' => $actions])->render();

        return $menu;
    }

    /**
     * Для получения списка всех привилегий в виде массива необходимо вначале получить роль пользователя.
     * Зная роль пользователя получаем коллекцию объектов Privilege  и преобразовываем её в массив.
     * @return array
     */
    private function getPrivilege() : array
    {
        $role_name = \Auth::user()->role_name;
        $privileges = Role::find($role_name)->privileges;
//        dd($privileges);
        $vars = [];
        $privileges->transform(function ($item, $key) use (&$vars) {
            $vars[] = $item->name;
        });

        return $vars;
    }

    /**
     * This method transforms the input array into an array with privileges
     *
     * @param $privileges array
     *
     * @return array
     */
    private function selectAction($privileges)
    {
        $mainMenu = [];

        foreach ($privileges as $privilege) {
            switch ($privilege) {
                case 'read_open':
                    $mainMenu[2] = $privilege;
                    break;

                case 'read_mi':
                    $mainMenu[3] = $privilege;
                    break;

                case 'read_doc':
                    $mainMenu[4] = $privilege;
                    break;

                case 'create_doc':
                    $mainMenu[5] = $privilege;
                    break;

                case 'read_user':
                    $mainMenu[0] = $privilege;
                    break;

                case 'create_user':
                    $mainMenu[1] = $privilege;
                    break;
            }
        }
        ksort($mainMenu);
        return $mainMenu;
    }
}
