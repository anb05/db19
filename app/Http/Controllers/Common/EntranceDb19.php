<?php

namespace Db19\Http\Controllers\Common;

use Db19\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Db19\ModelsDb\UserDb;
use \Illuminate\Database\QueryException;

class EntranceDb19 extends MainController
{
    /**
     * MainController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->title = 'Entrance to Information Recourse';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->attemptEntrance($request)) {
            $request->session()->put('login_db', $request->login);
            $request->session()->put('password_db', $request->password);

            $group = \Auth::user()->role_name;
            return redirect('/' . $group)->with('status', 'You were entered');
        }

        $errors = [$this->username() => trans('auth.failed')];

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Attempt to login in Db19
     */
    private function attemptEntrance(Request $request)
    {
        $activeUser = \Auth::user();
        $login = $activeUser->login;
        if ($login != $request->login) {
            return false;
        }

        \Config::set('database.connections.mysql_input_doc.username', $login);
        \Config::set('database.connections.mysql_input_doc.password', $request->password);
        try {
            $userDb = UserDb::find($activeUser->id);
            $activeUser->attempt = 0;
            $activeUser->save();
            return (isset($userDb) ? $userDb : true);
        } catch (QueryException $exception) {
            \Config::set('database.connections.mysql_input_doc.username', '');
            \Config::set('database.connections.mysql_input_doc.password', '');
            $activeUser->attempt += 1;
            $activeUser->save();
            if ($activeUser->attempt > \Config::get('db19.attemptDb')) {
                $activeUser->delete();
//                \Auth::logout();
                return redirect('/');
            }
            return false;
        }
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('common.loginDb19');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * This method defines the field for user identification
     * @see https://laravel.com/docs/5.4/authentication#authentication-quickstart
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }
}
