<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	// Gestion des accès aux routes
	$access = true;

	// Récupération du role
	if (Auth::guest()) {
		$role = 0;
	} else {
		$role = Auth::user()->id_role;
	}

	$method = Request::method();

	// Tout sauf administrateurs
	if ($role == 5) {
		switch (true) {
			// Utilisateurs
			case Request::isMethod('post'): $access = false; break; // Enregistrer
			case Request::isMethod('put'): $access = false; break; // Modifier
			case Request::isMethod('delete'): $access = false; break; // Supprimer
			case Request::is('users/create'): $access = false; break; // Formulaire de création
			case Request::is('users/*/edit'): $access = false; break; // Formulaire d'édition
			default: break;
		}
	}

	// Emission du role de l'utilisateur
	Session::flash('role', $role);

	// Redirection si role insuffisant
	if (!$access) {
		Session::flash('message', 'Permissions insuffisantes');
		Session::flash('alert', 'warning');
		return Redirect::to('/');
	}
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) {
		Session::flash('message', 'Vous devez être connecté pour voir cette page');
		Session::flash('alert', 'warning');
		return Redirect::guest('login');
	} else {
		//var_dump(Auth::user()->id_role);
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) {
		Session::flash('message', 'Vous êtes déjà connecté');
		Session::flash('alert', 'warning');
		return Redirect::to('/');
	}
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});