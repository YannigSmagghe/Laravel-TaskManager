<?php

Route::group(['middleware' => ['web', 'guest']], function () {

    $this->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('/login', 'Auth\LoginController@login');
    Route::post('/user', 'UserController@store');

});
Route::group(['middleware' => ['web', 'auth', 'auth.active']], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/tasks', 'TaskController@index');
    Route::get('/task/{id}/{status}', 'TaskController@updateStatus');
    Route::post('/task', 'TaskController@store');
//    Route::post('/task', 'testController@store');
    Route::get('/subtasks/{id}', 'SubTaskController@index');
    Route::get('/subtask/{id}/{status}', 'SubTaskController@updateStatus');
    Route::post('/subtask', 'SubTaskController@store');
    Route::get('/setting', 'UserController@index')->name('setting');
    Route::post('/setting', 'UserController@update');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['middleware' => ['web', 'auth', 'auth.active', 'moderator']], function () {

    Route::get('/task/{id}', 'TaskController@updateForm');
    Route::put('/task', 'TaskController@update');
    Route::get('/subtask/{id}', 'SubTaskController@updateForm');
    Route::put('/subtask', 'SubTaskController@update');

});

Route::group(['middleware' => ['web', 'auth', 'auth.active', 'admin']], function () {

    Route::delete('/task', 'TaskController@destroy');
    Route::delete('/subtask', 'SubTaskController@destroy');
    Route::get('/users', 'UserController@getUsers')->name('users');
    Route::get('/user/{id}', 'UserController@updateForm');
//    Route::post('/user', 'UserController@store');
    Route::put('/user', 'UserController@update');
    Route::delete('/user', 'UserController@destroy');

});