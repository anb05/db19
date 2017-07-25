<?php

namespace Db19\Http\Controllers\Admin;

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
    public function __construct()
    {
        $this->middleware('auth');

        $this->template = 'admin.home';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = $this->getUsers();
//        dd($data);
        return $this->render();
    }

    public function getUsers()
    {
        $users = User::all();
        return $users;
    }
}
