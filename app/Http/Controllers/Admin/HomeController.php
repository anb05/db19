<?php

namespace Db19\Http\Controllers\Admin;

use Db19\Repositories\MenuRepository;
use Db19\User;
use Illuminate\Http\Request;
use Db19\Http\Controllers\MainController;

/**
 * @property string template
 */
class HomeController extends MainController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(MenuRepository $menu_rep)
    {
        $this->middleware('auth');

        $this->template = 'admin.home';

        $this->menu_rep = $menu_rep;
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $this->data['mainMenu'] = $this->getMenu();
//        $menu = $this->getMenu();
//        dd($menu);
//        $this->data['users'] = $this->getUsers();
//        dd($data);
        return $this->render();
    }

    public function showUsers()
    {
        $this->data['mainMenu'] = $this->getMenu();
        $this->data['users'] = $this->getUsers();
        return $this->render();
    }

    /**
     * This method returns a collection of all users except for oneself
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers()
    {
        $oneself_id = \Auth::user()->id;
        $users = User::all()->where('id', '!=', $oneself_id);
        return $users;
    }

    protected function getMenu()
    {
        $menu = $this->menu_rep->get();

        return $menu;
    }
}
