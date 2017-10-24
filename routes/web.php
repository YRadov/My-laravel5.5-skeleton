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

use App\Core\Models\Permission;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin:'. Permission::VIEW_ADMIN]], function() {
	// /admin
	Route::get('/', 'IndexController@index')->name('adminIndex');

	Route::get('/permissions', 'PermissionsController@index')->name('perms');
	Route::post('/permissions', 'PermissionsController@edit')->name('perms-edit');

});
