<?php

namespace Db19\Http\Controllers\Admin;

//use Db19\ModelsApp\Privilege;
//use Db19\Repositories\MenuRepository;
use Db19\User;
use Config;
use Illuminate\Http\Request;
use Db19\Http\Controllers\MainController;

/**
 * @property string template
 */
class HomeController extends MainController
{
    const ID_SORT = 'id';

    const LOGIN_SORT = 'login';

    const FULL_NAME_SORT = 'full_name';

    const GROUP_SORT = 'group_name';

    const ROLE_SORT = 'role_name';

    const CREATED_SORT = 'created_at';

    const UPDATED_SORT = 'updated_at';

    const WITH_DELETE = 'withDelete';

    private $withDelete = false;

    private $columnSort = 'updated_at';

    private $directionSort = 'desc'; //asc
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        parent::__construct(/*new MenuRepository(new Privilege())*/);

        $this->middleware('auth');

        $this->template = 'admin.home';

        $this->title = 'Admin';
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return $this->render();
    }

    /**
     * @param Request $request
     * @param bool    $param
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUsers(Request $request, $param = false)
    {
        if ($request->session()->has('withDelete')) {
            $this->withDelete = $request->session()->get('withDelete');
        }
        if ($request->session()->has('columnSort')) {
            $this->columnSort = $request->session()->get('columnSort');
        }
        if ($request->session()->has('directionSort')) {
            $this->directionSort = $request->session()->get('directionSort');
        }

        if ($param && (
                (self::ID_SORT        === $param) ||
                (self::LOGIN_SORT     === $param) ||
                (self::FULL_NAME_SORT === $param) ||
                (self::GROUP_SORT     === $param) ||
                (self::ROLE_SORT      === $param) ||
                (self::CREATED_SORT   === $param) ||
                (self::UPDATED_SORT   === $param) ||
                (self::WITH_DELETE    === $param)
            )) {
            if ($param === self::WITH_DELETE) {
                $this->withDelete = (($this->withDelete === true) ? false : true);
                $request->session()->put(self::WITH_DELETE, $this->withDelete);
            } elseif ($param === $this->columnSort) {
                $this->directionSort = (($this->directionSort === 'desc') ? 'asc' : 'desc');
                $request->session()->put('directionSort', $this->directionSort);
            } else {
                $this->columnSort = $param;
                $request->session()->put('columnSort', $this->columnSort);
                $this->directionSort = 'asc';
                $request->session()->put('directionSort', $this->directionSort);
            }
        }

        $this->data['columnSort'] = $this->columnSort;
        $this->data['directionSort'] = $this->directionSort;

        $this->data['columnSort'] = $this->columnSort;
        $this->data['directionSort'] = $this->directionSort;

        $this->data['users'] = $this->getUsers();
        return $this->render();
    }

    /**
     * This method returns a collection of all users except for oneself
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers()
    {
        $oneself_id = \Auth::user()->id;
        if ($this->withDelete) {
            $users = User::withTrashed()
                ->where('id', '!=', $oneself_id)
                ->orderBy($this->columnSort, $this->directionSort)
                ->paginate(Config::get('db19.paginate'));
            return $users;
        }
        $users = User::where('id', '!=', $oneself_id)
            ->orderBy($this->columnSort, $this->directionSort)
            ->paginate(Config::get('db19.paginate'));
        return $users;
    }
}
