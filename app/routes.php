<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

/*
GET			/resource					index	resource.index
GET			/resource/create			create	resource.create
POST		/resource					store	resource.store
GET			/resource/{resource}		show	resource.show
GET			/resource/{resource}/edit	edit	resource.edit
PUT/PATCH	/resource/{resource}		update	resource.update
DELETE		/resource/{resource}		destroy	resource.destroy
*/
Route::resource('users', 'UserController');

Route::post('login', array('uses' => 'UserController@login'));

Route::get('login', array('as' => 'login', function()
{
	return View::make('login');
}))->before('guest');


Route::get('logout', array('as' => 'logout', function()
{
	Auth::logout();

	Session::flash('message', 'Successfully logged out');
	Session::flash('alert', 'success');
	return Redirect::to('/');
}))->before('auth');

Route::get('db', function()
{
	// Initialisation des tables (http://docs.laravel.fr/4.1/schema)

	// Utilisateurs
	Schema::dropIfExists('users');
	Schema::create('users', function($table)
	{
		$table->increments('id');
		$table->string('first_name', 32);
		$table->string('last_name', 32);
		$table->string('email', 320);
		$table->string('password', 60);
		$table->timestamps();
	});

	// Salles
	Schema::dropIfExists('rooms');
	Schema::create('rooms', function($table)
	{
		$table->increments('id');
		$table->string('name', 32);
		$table->integer('seats');
		$table->timestamps();
	});

	// Population des tables (http://docs.laravel.fr/4.1/migrations)
	// app/database/seeds/DatabaseSeeder.php
	Artisan::call('db:seed');

	Session::flash('message', 'Base de donnée mise à jour');
	return Redirect::to('/');
});