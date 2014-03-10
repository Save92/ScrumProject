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
	return View::make('hello');
});

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

	return 'Base de donnée mise à jour';
});