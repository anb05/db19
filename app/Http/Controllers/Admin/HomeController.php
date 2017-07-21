<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = $this->getUsers();
//        dd($data);
        return view('admin.home', $data);
    }

    public function getUsers()
    {
        $users = User::all();
        $users->transform(function ($item, $key) {
            $group = $item->group;
            $name = $group->name;
            unset($item->group_id);
            $item->group = $name;
            return $item;
        });
        return $users;
    }
}
