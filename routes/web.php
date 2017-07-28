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

Artisan::call('view:clear'); // Удалить строку после завершения разработки.

Route::get('/', ['middleware' => 'web', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/', ['middleware' => 'web',
    'uses' => 'Auth\LoginController@login',
    'as'   => 'login']);

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'Admin\HomeController@index')->name('admin');
    Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Admin\RegisterController@register');
    Route::get('/show', 'Admin\HomeController@showUsers')->name('viewUser');
    Route::match(
        ['get', 'post', 'delete'],
        '/edit/{user}',
        ['uses' => 'Admin\UserEditController@execute', 'as' => 'userEdit']
    );
});

Route::get('/open', function () {
    return url('/open/index.html');
})->name('viewDoc');

Route::get('/open/{mi?}', function () {
    return url('/open/index.html');
})->name('metaData');

Route::get('/open/{open?}', function () {
    return url('/open/index.html');
})->name('openDoc');

Route::get('/guest', function () {
    return redirect('/open');
});


//Route::any('/{somePrefix?}', function () {
//    return view('errors.404');
//});
