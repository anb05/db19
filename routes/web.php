<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return redirect('/home');
//    return view('welcome');
//});

Route::get('/', ['middleware' => 'web', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/', ['middleware' => 'web',
    'uses' => 'Auth\LoginController@login',
    'as'   => 'login']);
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
        Route::get('/', 'Admin\HomeController@index')->name('admin');
        Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Admin\RegisterController@register');
});

Route::any('/{somePrefix?}', function () {
    return view('errors.404');
});
