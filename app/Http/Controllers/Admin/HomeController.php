<?php

namespace Db19\Http\Controllers\Admin;

//use Db19\ModelsApp\Privilege;
//use Db19\Repositories\MenuRepository;
use Db19\User;
use Config;
//use Illuminate\Http\Request;
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
        parent::__construct(/*new MenuRepository(new Privilege())*/);

        $this->middleware('auth');

        $this->template = 'admin.home';
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
//        $menu = $this->getMenu();
//        dd($menu);
//        $this->data['users'] = $this->getUsers();
//        dd($data);
        return $this->render();
    }

    public function showUsers($withDelete = false)
    {
        $this->data['mainMenu'] = $this->getMenu();
        $this->data['users'] = $this->getUsers($withDelete);
        return $this->render();
    }

    /**
     * This method returns a collection of all users except for oneself
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($withDelete = false)
    {
        $oneself_id = \Auth::user()->id;
        if ($withDelete) {
            $users = User::withTrashed()
                ->where('id', '!=', $oneself_id)
                ->paginate(Config::get('db19.paginate'));
            return $users;
        }
        $users = User::where('id', '!=', $oneself_id)
            ->paginate(Config::get('db19.paginate'));
        return $users;
    }
}
