<?php

namespace Db19\Http\Controllers\Admin;

use Db19\ModelsApp\Group;
use Db19\Repositories\GroupRepository;
use Db19\Repositories\RoleRepository;
use Db19\Repositories\UserRepository;
use Illuminate\Http\Request;
use Db19\Http\Controllers\MainController;
use Db19\Repositories\MenuRepository;
use Db19\User;
use Db19\ModelsApp\Role;

class UserEditController extends MainController
{
    private $user_rep;

    private $request;

    public function __construct(
//        MenuRepository $menu_rep,
        GroupRepository $group_rep,
        RoleRepository $role_rep,
        UserRepository $user_rep,
        Request $request
    ) {
        parent::__construct();

//        $this->menu_rep = $menu_rep;

        $this->group_rep = $group_rep;

        $this->role_rep = $role_rep;

        $this->user_rep = $user_rep;

        $this->request = $request;

        $this->template = 'admin.user_edit';

        $this->title = 'User edits';

        $this->keyWords = 'User, DataBase, Edit, Registration';

        $this->metaDesc = 'For changed users data';
    }

    public function execute($id/*User $user*/)
    {
        $user = User::withTrashed()->find($id);
        $this->user_rep->setInstance($user);
        $this->data['oldUserData'] = $this->user_rep->getInstance()->toArray();
        $action = strtolower($this->request->method()) . 'Action';
        $result = $this->$action();

        return $result;
    }

    private function postAction()
    {
        $status = '';
        $inputData = $this->request->except('_token');
        $oldData = $this->data['oldUserData'];

        if ($this->user_rep->changeFullName($this->request)) {
            $status .= trans('ua.FullNameChanged');
        }

        if ($this->user_rep->changeAppPassword($this->request)) {
            $status .= "<br>\n" . trans('ua.changed App password');
        } else {
            $status .= "<br>\n" . trans('ua.Password was not changed');
        }

        if ($this->user_rep->changeGroupAndRole($this->request, $this->user_rep->getInstance())) {
            $status .= "<br>\n" . trans('ua.user data changed');
        } else {
            $status .= "<br>\n" . trans('ua.user data has not been changed');
        }

        $this->request->session()->flash('status', $status);
        return redirect('/admin');
    }

    private function restoreAction()
    {
        if ($this->user_rep->getInstance()->restore()) {
            return redirect()->route('admin')->with('status', trans('ua.User was restored'));
        } else {
            return redirect()->route('admin')->with('status', trans('ua.User recovery failed'));
        }
    }

    private function deleteAction()
    {
        $this->user_rep->getInstance()->delete();
        return redirect()->route('admin')->with('status', trans('ua.user deleted'));
    }

    private function getAction()
    {
        if ($this->user_rep->getInstance()->trashed()) {
            return redirect()->route('admin')->with('status', trans('ua.The user must first be recovered'));
        }

        if (view()->exists($this->template)) {
            $this->data['groups'] = $this->group_rep->getAll();
            $this->data['roles'] = $this->role_rep->getAll();

            $usersGroup = \Auth::user()->role_name;
            if ($usersGroup === 'admin') {
                $formRedactUser = view('admin.user_edit_db', $this->data)->render();
                $this->data['userDataFromDB'] = $formRedactUser;
            }
            return $this->render();
        }
        abort(404);
    }
}
