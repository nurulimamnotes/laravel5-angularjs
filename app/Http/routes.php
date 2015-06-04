<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('/system', 'SystemController@index');

Route::group(array('prefix'=>'/api'),function(){
	// User Management
   Route::resource('users','UserController');
   Route::get('user-limit', 'UserController@paginate');
    // Role Management
   Route::resource('roles','RolesController');
    // Assign Role
   Route::resource('role','RoleController');
});

// Protect actions on the user controller => https://github.com/Zizaco/entrust
//Entrust::routeNeedsRole('system*', 'admin');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
