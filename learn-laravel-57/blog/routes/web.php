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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'UserController@index')->name('admin');

Route::get('/listUser', 'UserController@listUser')->name('listUser');

Route::post('/listUser', 'UserController@listUser')->name('listUser');

Route::get('/addUser', 'UserController@getAddUser')->name('getAddUser');

Route::post('/addUser', 'UserController@addUser')->name('addUser');

Route::get('/deleteUser', 'UserController@deleteUser')->name('deleteUser');

Route::get('/editUser', 'UserController@getEditUser')->name('getEditUser');

Route::post('/editUser', 'UserController@editUser')->name('editUser');
