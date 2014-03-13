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
	if (!Auth::guest()) {
		$role = Auth::user()->id_role;
	} else {
		$role = 0;
	}
	// Emission du role de l'utilisateur
	Session::flash('role', $role);
});


App::after(function($request, $response)
{
	if (!Auth::guest()) {
		$role = Auth::user()->id_role;
	} else {
		$role = 0;
	}
	// Emission du role de l'utilisateur
	Session::flash('role', $role);
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
		Session::flash('message', 'Veuillez vous connecter');
		Session::flash('alert', 'warning');

		return Redirect::guest('login');
	} else {
		// Gestion des accès aux routes
		$access = true;

		// Récupération du role
		$role = Auth::user()->id_role;

		$method = Request::method();

		// Restriction des accès
		if ($role < 2) {
			switch (true) {
				// Modifier
				case Request::isMethod('put'):
					$access = false; break;
				// Enregistrer sauf login
				case Request::isMethod('post') && !Request::is('login'):
					$access = false; break;
				// Supprimer
				case Request::isMethod('delete'):
					$access = false; break;
				// Formulaire d'ajout
				case Request::is('*/create'):
					$access = false; break;
				// Formulaire de modification
				case Request::is('*/edit'):
					$access = false; break;
				default: break;
			}
		}

		// Redirection si role insuffisant
		if (!$access) {
			Session::flash('message', 'Permissions insuffisantes');
			Session::flash('alert', 'warning');
			if (Auth::guest()) {
				return Redirect::to('login');
			} else {
				return Redirect::to('/');
			}
		}
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