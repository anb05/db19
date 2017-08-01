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

        if ($request->isMethod('delete')) {
            $user->delete();
            return redirect()->route('admin')->with('status', trans('ua.user deleted'));
        }

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


                $this->createNewCustomer($inputData['group'], $inputData['role']);


                $status .= 'change to admin';
            }




//            dd($inputData);




            $request->session()->flash('status', $status);
            return redirect('/admin');
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

    private function changeAppPassword(Request $request, User $user, $inputData)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user->password = bcrypt($inputData['password']);
        return $user->save();
    }

    private function createNewCustomer($group, $role)
    {
//        $privileges = Role::find($role)->privileges;
        $privileges = $this->role_rep->privileges;
        dd($privileges);
    }


}
