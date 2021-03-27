<?php

use Illuminate\Support\Facades\Route;
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
Route::middleware(['userlogincheck'])->group(function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('loginCheck');
});
Route::middleware(['usercheck'])->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('teams')->name('teams.')->group(function () {
		Route::get('', 'TeamController@index')->name('index');
		Route::get('create', 'TeamController@create')->name('create');
		Route::post('', 'TeamController@store')->name('store');
		Route::get('/edit/{team}', 'TeamController@edit')->name('edit');
		Route::put('{team}', 'TeamController@update')->name('update');
		Route::delete('{team}', 'TeamController@delete')->name('delete');
	});

    Route::prefix('users')->name('users.')->group(function () {
		Route::get('', 'UserController@index')->name('index');
		Route::get('create', 'UserController@create')->name('create');
		Route::post('', 'UserController@store')->name('store');
		Route::get('/edit/{user}', 'UserController@edit')->name('edit');
		Route::put('{user}', 'UserController@update')->name('update');
		Route::delete('{user}', 'UserController@delete')->name('delete');
	});

    Route::prefix('roles')->name('roles.')->group(function () {
		Route::get('', 'RoleController@index')->name('index');
		Route::get('create', 'RoleController@create')->name('create');
		Route::post('', 'RoleController@store')->name('store');
		Route::get('/edit/{role}', 'RoleController@edit')->name('edit');
		Route::put('{role}', 'RoleController@update')->name('update');
		Route::delete('{role}', 'RoleController@delete')->name('delete');
	});

	Route::prefix('role-permissions')->group(function () {
		Route::get('index/{id}', 'RolePermissionController@index')->name('role-permissions.index');
		Route::get('new/{id}', 'RolePermissionController@new')->name('role-permissions.new');
		Route::post('store', 'RolePermissionController@store')->name('role-permissions.store');
		Route::get('delete/{role_permission}', 'RolePermissionController@delete')->name('role-permissions.delete');
	});

	Route::prefix('tasks')->name('tasks.')->group(function () {
		Route::get('', 'TaskController@index')->name('index');
		Route::get('create', 'TaskController@create')->name('create');
		Route::post('', 'TaskController@store')->name('store');
		Route::get('/edit/{task}', 'TaskController@edit')->name('edit');
		Route::put('{task}', 'TaskController@update')->name('update');
		Route::delete('{task}', 'TaskController@delete')->name('delete');
	});

	Route::prefix('ajax')->group(function () {
			Route::get('/team/user', 'AjaxController@teamUser');
	});

});