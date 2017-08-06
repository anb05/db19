<?php
/**
 */

namespace Db19\Repositories;

use Db19\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Db19\ModelsDb\UserDb;

class UserRepository extends Repository
{
    use ValidatesRequests;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function changeAppPassword(Request $request)
    {
        if (isset($request->password)) {   // (isset($request->input('password' {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);

            $this->model->password = bcrypt($request->input('password'));
            return $this->model->save();
        }
    }

    public function changeGroupAndRole(Request $request, User $user)
    {
        if (isset($request->passwordDb)) {
            echo '<pre>';
            echo "<h3> просмотр username:  " . \Config::get('database.connections.mysql_input_doc.username') . "</h3>";
            echo "<h3> просмотр password:  " . \Config::get('database.connections.mysql_input_doc.password') . "</h3>";
            echo '</pre>';
            $this->validate($request, [
                'passwordDb' => 'required|string|min:6|confirmed'
            ]);

            if ($objectUser = UserDb::find($user->id)) {
                //
            }
            die();
            $userData = ['id' => $user->id, 'name' => $user->login];
            $objectUser = new UserDb($userData);
            $objectUser->save();

            dump($user);
            dd($objectUser);
        }
        return false;
    }
}