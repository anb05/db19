<?php
/**
 */

namespace Db19\Repositories;

use Db19\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Db19\ModelsDb\UserDb;

/**
 * Class UserRepository
 * This class is designed to manage users
 *
 * @package Db19\Repositories
 */
class UserRepository extends Repository
{
    use ValidatesRequests;

    /**
     * Repository constructor.
     *
     * @param User $user active user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function changeFullName(Request $request)
    {
//        dump($this->model);
//        echo "<h2>REQUEST</h2>";
//        dd($request);
        if ($this->model->full_name != $request->full_name) {
            $this->model->full_name = $request->full_name;

            return $this->model->save();
        }
    }

    /**
     * This method checks two passwords and changes the old password in the application.
     * @param Request $request
     *
     * @return bool
     */
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

    /**
     * This method takes data from the database and from the query and creates a new USER in the DBMS.
     * This new USER given GROUP and ROLE. His permissions accord his role for his group.
     * Each group has its own table(view) in db19_input_doc
     *
     * @param Request $request
     * @param User    $user
     *
     * @return bool
     */
    public function changeGroupAndRole(Request $request, User $user)
    {
        try {
            if (isset($request->passwordDb)) {
                $this->validate($request, [
                    'passwordDb' => 'required|string|min:6|confirmed'
                ]);

                if ($userApp = User::find($user->id)) {
                    if (($request->group == 'guest') || ($request->role == 'guest')) {
                        $userApp->group_name = 'guest';
                        $userApp->role_name = 'guest';
                    } else {
                        $userApp->group_name = $request->group;
                        $userApp->role_name = $request->role;
                    }
                    $userApp->save();
                }

                if ($objectUser = UserDb::find($user->id)) {
                    $this->deleteUserDb($objectUser);
                }

                $userData = ['id' => $user->id, 'name' => $user->login];
                $objectUser = new UserDb($userData);
                $objectUser->save();

                $query = "CREATE USER '" . $objectUser->name . "'@'localhost' IDENTIFIED BY '" . $request->passwordDb . "'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                return $this->createQueryPrivilege($request, $objectUser);
            }
        } catch (QueryException $exception) {
            $userApp->group_name = 'guest';
            $userApp->role_name = 'guest';
            $userApp->save();

            $objectUser->delete();
            $this->deleteUserDb($objectUser);
            return false;
        }
    }

    private function createQueryPrivilege(Request $request, UserDb $objectUser)
    {
        $role = ($request->group == 'guest') ? 'guest' : $request->role;
        switch ($role) {
            case 'guest':
                $query = "GRANT USAGE ON *.* TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);
                break;

            case 'viewer':
                /*
                $query = "GRANT SELECT ON confidential_inventorys TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON no_confidential_inventorys TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON no_confidential_output TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON confidential_output TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON no_confidential_numbers TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON confidential_numbers TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON no_confidential_disks TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT ON confidential_disks TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT SELECT (header) ON documents TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);
                break;
                */

            case 'regular':
                $query = "GRANT SELECT ON db19_input_doc.* TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);
                break;

            case 'writer':
                $query = "GRANT SELECT, INSERT ON db19_input_doc.* TO '" . $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);
                break;

            case 'moderator':
                $query  = "GRANT SELECT, INSERT, UPDATE, DELETE ON db19_input_doc.* TO '";
                $query .= $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);
                break;

            case 'admin':
                $query  = "GRANT ALL PRIVILEGES ON db19_input_doc.* TO '";
                $query .= $objectUser->name . "'@'localhost'";
                \DB::connection("mysql_input_doc")->unprepared($query);

                $query = "GRANT CREATE USER ON *.* TO '" . $objectUser->name . "'@'localhost' WITH GRANT OPTION";
                \DB::connection("mysql_input_doc")->unprepared($query);
        }
        return true;
    }

    private function deleteUserDb(UserDb $userDb)
    {
        /*
         * This strings intend for MySQL
         */
        $query = "DROP USER '". $userDb->name . "'@'localhost'";
        \DB::connection("mysql_input_doc")->unprepared($query);
        //************************************************************
        $userDb->delete();
    }
}
