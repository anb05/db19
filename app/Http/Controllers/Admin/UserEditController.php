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
        MenuRepository $menu_rep,
        GroupRepository $group_rep,
        RoleRepository $role_rep,
        UserRepository $user_rep,
        Request $request
    ) {
        $this->menu_rep = $menu_rep;

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









/*
        if ($request->isMethod('post')) {
            $status = '';
            $inputData = $request->except('_token');
            if (isset($inputData['password'])) {
                if ($this->changeAppPassword($request, $user, $inputData)) {
                    $status = trans('ua.changed App password');
                }
            }
//
            if (($inputData['group'] === 'guest') || ($inputData['role'] === 'guest')) {
                $status .= trans('ua.Other users data was not changing');
            } elseif (($inputData['group'] ===  'admin') && ($inputData['role'] === 'admin')) {
                $this->validate($request, [
                    'passwordDb' => 'required|string|min:6|confirmed'
                ]);


                $this->createNewCustomer($inputData['group'], $inputData['role']);


                $status .= 'change to admin';
            } else {
            }




            dd($inputData);




            $request->session()->flash('status', $status);
            return redirect('/admin');
        }
*/
    }

    private function postAction()
    {
        $status = '';
        $inputData = $this->request->except('_token');
        $oldData = $this->data['oldUserData'];

        if ($this->user_rep->changeAppPassword($this->request)) {
            $status = trans('ua.changed App password');
        } else {
            $status = trans('ua.Password was not changed');
        }

        if ($this->user_rep->changeGroupAndRole($this->request, $this->user_rep->getInstance())) {
            $status .= "<br>\n" . trans('ua.user data changed');
        } else {
            $status .= "<br>\n" . trans('ua.user data has not been changed');
        }






//        dump($inputData);
//        echo "<h1>oldData</h1>";
//        dd($oldData);

/*
        if (($oldData['group_name'] == $inputData['group']) && ($oldData['role_name'] == $inputData['role'])) {
            $status .= trans('ua.Other users data was not changing');
        } else {
            $this->validate($this->request, [
                'passwordDb' => 'required|string|min:6|confirmed'
            ]);

            // Вызываем метод формирования запроса на смену группы и роли в db19.users

//            $this->changeGroupAndRole();
        }
*/

//        dd("<h1>Password changing</h1>");

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

            $usersGroup = \Auth::user()->group_name;
            if ($usersGroup === 'admin') {
                $formRedactUser = view('admin.user_edit_db', $this->data)->render();
                $this->data['userDataFromDB'] = $formRedactUser;
            }
            return $this->render();
        }
        abort(404);
    }

    private function createNewCustomer($group, $role)
    {
        $privileges = Role::find($role)->privileges;
        dd($privileges);
    }


}
