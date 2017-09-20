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



Route::get('/entrance', ['middleware' => ['web', 'auth', 'guest19'],
    'uses' => 'Common\EntranceDb19@showLoginForm']);

Route::post('/entrance', ['middleware' => ['web', 'auth', 'guest19'],
    'uses' => 'Common\EntranceDb19@login',
    'as' => 'login19']);




Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'Admin\HomeController@index')->name('admin');

    // This Route group was defined to protect the general database.
    Route::group(['middleware' => 'db19'], function () {
        Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('create_user');
        Route::post('/register', 'Admin\RegisterController@register');
        Route::get('/show/{withDelete?}', 'Admin\HomeController@showUsers')->name('read_user');
        Route::match(
            ['get', 'post', 'delete', 'restore'],
            '/edit/{user}',
            ['uses' => 'Admin\UserEditController@execute', 'as' => 'userEdit']
        );
    });
});

Route::group(['prefix' => 'writer', 'middleware' => 'auth'], function () {
    Route::get('/', 'Writer\HomeController@index')->name('writer');

    Route::group(['middleware' => 'db19'], function () {
        Route::get('/create/{document_type?}', 'Writer\CreateDocument@index')
            ->name('create_doc');

        Route::get('/show_drafts/{document_type?}', 'Writer\CreateDocument@showDrafts')
            ->name('show_drafts');

        Route::post('/create', 'Writer\CreateDocument@create')
            ->name('handle_form');

        Route::match(
            ['get', 'post', 'delete', 'prepared'],
            '/edit/{draft}',
            'Writer\DraftEditController@execute'
        )->name('edit_draft');

        Route::match(
            ['post', 'delete'],
            '/body/{body?}',
            'Writer\BodyController@execute'
        )->name('manipulate_body');

        Route::match(
            ['post', 'delete'],
            '/appendices/{appendix?}',
            'Writer\AppendixController@execute'
        )->name('manipulate_appendices');

        Route::match(
            ['post', 'delete'],
            '/control/{control?}',
            'Writer\ControlController@execute'
        )->name('manipulate_control');
    });
});





Route::group(['prefix' => 'guest', 'middleware' => ['auth',]], function () {
    Route::get('/', 'Open\OpenResources@execute')->name('read_open');

    Route::get('/{mi?}', function () {
        return url('/open/index.html');
    })->name('read_mi');

    Route::get('/{open?}', function () {
        return url('/open/index.html');
    })->name('read_doc');
//
    Route::get('/guest', function () {
        return redirect('/open');
    });
});


//Route::any('/{somePrefix?}', function () {
//    return view('errors.404');
//});
