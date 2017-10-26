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
    Route::group(['middleware' => ['db19', 'checkPath']], function () {
        Route::get('/register', 'Admin\RegisterController@showRegistrationForm')
            ->name('admin_create_user');

        Route::post('/register', 'Admin\RegisterController@register');

        Route::get('/show/{withDelete?}', 'Admin\HomeController@showUsers')
            ->name('admin_read_user');

        Route::match(
            ['get', 'post', 'delete', 'restore'],
            '/edit/{user}',
            ['uses' => 'Admin\UserEditController@execute', 'as' => 'userEdit']
        );
    });

    Route::get('/open', 'Open\OpenResources@execute')->name('admin_read_open');
    Route::get('/mi', 'Open\OpenResources@execute')->name('admin_read_mi');
    Route::get('/doc', 'Open\OpenResources@execute')->name('admin_read_doc');
});

Route::group(['prefix' => 'writer', 'middleware' => 'auth'], function () {
    Route::get('/', 'Writer\HomeController@index')->name('writer');

    Route::group(['middleware' => ['db19', 'checkPath']], function () {
        Route::get('/create/{document_type?}', 'Writer\CreateDocument@index')
            ->name('writer_create_doc');

        Route::get('/show_drafts/{document_type?}', 'Writer\CreateDocument@showDrafts')
            ->name('writer_show_drafts');

        Route::post('/create', 'Writer\CreateDocument@create')
            ->name('writer_handle_form');

        Route::match(
            ['get', 'post', 'delete', 'prepared'],
            '/edit/{draft}',
            'Writer\DraftEditController@execute'
        )->name('writer_edit_draft');

        Route::match(
            ['post', 'delete'],
            '/body/{body?}',
            'Writer\BodyController@execute'
        )->name('writer_manipulate_body');

        Route::match(
            ['post', 'delete'],
            '/appendices/{appendix?}',
            'Writer\AppendixController@execute'
        )->name('writer_manipulate_appendices');

        Route::match(
            ['post', 'delete'],
            '/control/{control?}',
            'Writer\ControlController@execute'
        )->name('writer_manipulate_control');

        Route::match(
            ['post', 'delete'],
            '/resolution/{resolution?}',
            'Writer\ResolutionController@execute'
        )->name('writer_manipulate_resolution');
    });


    Route::get('/open', 'Open\OpenResources@execute')->name('writer_read_open');
    Route::get('/mi', 'Open\OpenResources@execute')->name('writer_read_mi');
    Route::get('/doc', 'Open\OpenResources@execute')->name('writer_read_doc');
});

Route::group(['prefix' => 'moderator', 'middleware' => 'auth'], function () {
    Route::get('/', 'Moderator\HomeController@index')->name('moderator');

    Route::group(['middleware' => ['db19', 'checkPath']], function () {
        Route::get('/create/{document_type?}', 'Moderator\CreateDocument@index')
            ->name('moderator_create_doc');

        Route::get('/show_drafts/{document_type?}', 'Moderator\CreateDocument@showDrafts')
            ->name('moderator_show_drafts');

        Route::get('/show_prepareds/{document_type?}', 'Moderator\CreateDocument@showPrepareds')
            ->name('moderator_show_prepareds');

        Route::post('/create', 'Moderator\CreateDocument@create')
            ->name('moderator_handle_form');

        Route::match(
            ['get', 'post', 'delete', 'prepared'],
            '/edit/{draft}',
            'Moderator\DraftEditController@execute'
        )->name('moderator_edit_draft');

        Route::match(
            ['post', 'delete'],
            '/body/{body?}',
            'Moderator\BodyController@execute'
        )->name('moderator_manipulate_body');

        Route::match(
            ['post', 'delete'],
            '/appendices/{appendix?}',
            'Moderator\AppendixController@execute'
        )->name('moderator_manipulate_appendices');

        Route::match(
            ['post', 'delete'],
            '/control/{control?}',
            'Moderator\ControlController@execute'
        )->name('moderator_manipulate_control');

        Route::match(
            ['post', 'delete'],
            '/resolution/{resolution?}',
            'Moderator\ResolutionController@execute'
        )->name('moderator_manipulate_resolution');

        Route::post('direct/{prepared}', 'Moderator\PreparedDirectTo@execute')
            ->name('prepared_to');

        Route::get('detail_view/{documentId}', 'Moderator\DetailSurveyDocument@execute')
            ->name('detail_survey_info');

        Route::post('binding/{documentId}', 'Moderator\BindingWithGroup@execute')
            ->name('bind_document_with_group')
            ->where('documentId', '[0-9]+');

        Route::post('view_body/{bodyId}', 'Moderator\ViewBody@execute')
            ->name('view_body')
            ->where('bodyId', '[0-9]+');

        Route::post('view_appendix/{appendixId}', 'Moderator\ViewAppendix@execute')
            ->name('view_appendix')
            ->where('appendixId', '[0-9]+');
    });


    Route::get('/open', 'Open\OpenResources@execute')->name('moderator_read_open');
    Route::get('/mi', 'Open\OpenResources@execute')->name('moderator_read_mi');
    Route::get('/doc', 'Open\OpenResources@execute')->name('moderator_read_doc');
});






Route::group(['prefix' => 'guest', 'middleware' => ['auth',]], function () {
    Route::get('/', 'Open\OpenResources@execute')->name('guest');

    Route::get('/open', 'Open\OpenResources@execute')->name('guest_read_open');
    Route::get('/mi', 'Open\OpenResources@execute')->name('guest_read_mi');
    Route::get('/doc', 'Open\OpenResources@execute')->name('guest_read_doc');
});
