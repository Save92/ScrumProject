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

Route::get('/', array('as' => 'home', function()
{
	return View::make('index');
}));

Route::group(array('before' => 'auth'), function()
{
	Route::get('logout', array('as' => 'logout', function()
	{
		Auth::logout();

		Session::flash('message', 'Successfully logged out');
		Session::flash('alert', 'success');
		return Redirect::to('/');
	}));
});

Route::group(array('before' => 'gest'), function()
{
	Route::post('login', array('uses' => 'UserController@login'));

	Route::get('login', array('as' => 'login', function() {
		return View::make('login');
	}));
});

/*
Route::resource('resources', 'ResourceController');

GET			/resource					index	resource.index
GET			/resource/create			create	resource.create
POST		/resource					store	resource.store
GET			/resource/{resource}		show	resource.show
GET			/resource/{resource}/edit	edit	resource.edit
PUT/PATCH	/resource/{resource}		update	resource.update
DELETE		/resource/{resource}		destroy	resource.destroy
*/

Route::resource('users', 'UserController');

Route::resource('formations', 'FormationController');

Route::resource('classes', 'ClasseController');

Route::resource('matieres', 'MatiereController');

/*
* Init / mise à jour BDD
*/
Route::get('db', function()
{
	// Initialisation des tables (http://docs.laravel.fr/4.1/schema)
	Schema::dropIfExists('cantines');
	Schema::dropIfExists('classes');
	Schema::dropIfExists('utilisations');
	Schema::dropIfExists('reservations');
	Schema::dropIfExists('compositions');
	Schema::dropIfExists('notes');
	Schema::dropIfExists('cours');
	Schema::dropIfExists('matieres');
	Schema::dropIfExists('thematiques');
	Schema::dropIfExists('salles');
	Schema::dropIfExists('materiels');
	Schema::dropIfExists('classes');
	Schema::dropIfExists('formations');
	Schema::dropIfExists('users');
	Schema::dropIfExists('roles');

	// Roles
	Schema::create('roles', function($table)
	{
		$table->integer('id')->unsigned();
		$table->primary('id');
		$table->string('libelle', 32);
		$table->timestamps();
	});

	// Utilisateurs
	Schema::create('users', function($table)
	{
		$table->increments('id');
		$table->string('prenom', 32);
		$table->string('nom', 32);
		$table->string('mail', 320);
		$table->string('telephone', 20);
		$table->integer('id_role')->unsigned();
		$table->foreign('id_role')->references('id')->on('roles');
		$table->string('password', 60);
		$table->timestamps();
	});

	// Diplomes
	Schema::create('diplomes', function($table)
	{
		$table->increments('id');
		$table->string('libelle', 32);
		$table->timestamps();
	});

	// Formations
	Schema::create('formations', function($table)
	{
		$table->increments('id');
		$table->string('libelle', 32);
		$table->text('conditions');
		$table->integer('id_user')->unsigned();
		$table->foreign('id_user')->references('id')->on('users');
		$table->integer('id_diplome')->unsigned();
		$table->foreign('id_diplome')->references('id')->on('diplomes');
		$table->timestamps();
	});

	// Classes
	Schema::create('classes', function($table)
	{
		$table->increments('id');
		$table->string('libelle', 32);
		$table->string('annee'; 32);
		$table->integer('id_user')->unsigned();
		$table->foreign('id_user')->references('id')->on('users');
		$table->integer('id_formation')->unsigned();
		$table->foreign('id_formation')->references('id')->on('formations');
		$table->timestamps();
	});

	// Thématiques
	Schema::create('thematiques', function($table)
	{
		$table->increments('id');
		$table->string('libelle', 32);
		$table->timestamps();
	});

	// Salles
	Schema::create('salles', function($table)
	{
		$table->increments('id');
		$table->string('libelle', 32);
		$table->timestamps();
	});

	// Matières
	Schema::create('matieres', function($table)
	{
		$table->increments('id');
		$table->string('libelle', 32);
		$table->integer('id_thematique')->unsigned();
		$table->foreign('id_thematique')->references('id')->on('thematiques');
		$table->timestamps();
	});

	// Cours
	Schema::create('cours', function($table)
	{
		$table->increments('id');
		$table->datetime('start');
		$table->datetime('end');
		$table->integer('id_user')->unsigned();
		$table->foreign('id_user')->references('id')->on('users');
		$table->integer('id_salle')->unsigned();
		$table->foreign('id_salle')->references('id')->on('salles');
		$table->integer('id_matiere')->unsigned();
		$table->foreign('id_matiere')->references('id')->on('matieres');
		$table->timestamps();
	});

	// Matériel
	Schema::create('materiels', function($table)
	{
		$table->increments('id');
		$table->string('description', 150);
		$table->timestamps();
	});

	// Reservations
	Schema::create('reservations', function($table)
	{
		$table->primary(array('id_user', 'id_materiel'));
		$table->datetime('start');
		$table->datetime('end');
		$table->integer('id_user')->unsigned();
		$table->foreign('id_user')->references('id')->on('users');
		$table->integer('id_materiel')->unsigned();
		$table->foreign('id_materiel')->references('id')->on('materiels');
		$table->timestamps();
	});

	// Utilisations
	Schema::create('utilisations', function($table)
	{
		$table->primary(array('id_salle', 'id_matiere'));
		$table->integer('id_salle')->unsigned();
		$table->foreign('id_salle')->references('id')->on('salles');
		$table->integer('id_matiere')->unsigned();
		$table->foreign('id_matiere')->references('id')->on('matieres');
		$table->timestamps();
	});

	// Compositions
	Schema::create('compositions', function($table)
	{
		$table->primary(array('id_matiere', 'id_formation'));
		$table->integer('coef');
		$table->integer('id_matiere')->unsigned();
		$table->foreign('id_matiere')->references('id')->on('matieres');
		$table->integer('id_formation')->unsigned();
		$table->foreign('id_formation')->references('id')->on('formations');
		$table->timestamps();
	});

	// Notes
	Schema::create('notes', function($table)
	{
		$table->primary(array('id_user', 'id_formation', 'id_matiere'));
		$table->float('valeur');
		$table->integer('id_user')->unsigned();
		$table->foreign('id_user')->references('id')->on('users');
		$table->integer('id_formation')->unsigned();
		$table->foreign('id_formation')->references('id')->on('formations');
		$table->integer('id_matiere')->unsigned();
		$table->foreign('id_matiere')->references('id')->on('matieres');
		$table->timestamps();
	});

	// Population des tables (http://docs.laravel.fr/4.1/migrations)
	// app/database/seeds/DatabaseSeeder.php
	Artisan::call('db:seed');

	Session::flash('message', 'Base de donnée mise à jour');
	return Redirect::to('/');
});

HTML::macro('menu_li', function($route, $text) {
	if( Request::path() == $route ) {
		$active = "class = 'active'";
	} else {
		$active = '';
	}

	return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
});

// includes?
// séparation boutons/bt data/bt, view table auto ??
HTML::macro('show_user', function($user, $options) {
	$el = '<a href="' . URL::to('users/' . $user->id) . '"><h3>' . $user->getName() . '</h3></a><p>' . $user->getRole() . '<br/>' . $user->mail . '<br/>' . $user->telephone . '</p>';
	if (true === $options) {
		$el.= '<a class="btn btn-small btn-success" href="' . URL::to('users/' . $user->id) . '">Afficher</a>' . ' ' .
		'<a class="btn btn-small btn-info" href="' . URL::to('users/' . $user->id . '/edit') . '">Modifier</a>' . ' ' .
		Form::open(array('url' => 'users/' . $user->id, 'class' => 'delete')) .
		Form::hidden('_method', 'DELETE') .
		Form::submit('Supprimer', array('class' => 'btn btn-danger')) .
		Form::close();
	}

	return $el;
});

HTML::macro('crud', function($url) {
	$el = '<a class="btn btn-small btn-success" href="' . URL::to($url) . '">Afficher</a>' . ' ' .
	'<a class="btn btn-small btn-info" href="' . URL::to($url . '/edit') . '">Modifier</a>' . ' ' .
	Form::open(array('url' => $url, 'class' => 'delete')) .
	Form::hidden('_method', 'DELETE') .
	Form::submit('Supprimer', array('class' => 'btn btn-danger')) .
	Form::close();

	return $el;
});
