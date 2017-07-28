<?php

namespace Db19\Http\Controllers\Admin;

use Db19\ModelsApp\Group;
use Db19\Repositories\GroupRepository;
use Db19\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Db19\Http\Controllers\MainController;
use Db19\Repositories\MenuRepository;
use Db19\User;

class UserEditController extends MainController
{
    public function __construct(
        MenuRepository $menu_rep,
        GroupRepository $group_rep,
        RoleRepository $role_rep
    ) {
        $this->menu_rep = $menu_rep;

        $this->group_rep = $group_rep;

        $this->role_rep = $role_rep;

        $this->template = 'admin.user_edit';

        $this->title = 'User edits';

        $this->keyWords = 'User, DataBase, Edit, Registration';

        $this->metaDesc = 'For changed users data';
    }

    public function execute(User $user, Request $request)
    {
        $oldUserData = $user->toArray();

        if ($request->isMethod('post')) {
            dd($request->except('_token'));
        }

        if (view()->exists($this->template)) {
            $this->data['oldUserData'] = $oldUserData;
            $this->data['groups'] = $this->group_rep->getAll();
            $this->data['roles'] = $this->role_rep->getAll();

            $authUser = \Auth::user()->group_name;
            if ($authUser === 'admin') {
                $formRedactUser = view('admin.user_edit_db', $this->data)->render();
                $this->data['userDataFromDB'] = $formRedactUser;
            }

            return $this->render();
        }
        abort(404);
    }
}
