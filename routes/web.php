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
		Route::delete('{team}', 'TeamController@destroy')->name('destroy');
	});
});