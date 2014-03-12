<?php

class UserController extends BaseController {

	public function __construct()
	{
		//$this->beforeFilter('auth', array('except' => 'login'));
	}

	protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 * GET /
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		$this->layout->content = View::make('user.index')->with('users', $users);

		/*$this->layout->content = View::make('layouts.index')->with(
			'items', array(
				$users,
				array(
					array('prenom', 'Prénom'),
					array('nom', 'Nom'),
					array('mail', 'Adresse mail'),
					array('telephone', 'Téléphone'),
					array('id_role', 'Role')
				)
			)
		);*/

	}

	/**
	 * Display the specified resource.
	 * GET /resource/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		$this->layout->content = View::make('user.show')->with('user', $user);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::all();

		$this->layout->content = View::make('layouts.create')->with(
			'items', array(
				'users' => array(
					array('prenom', 'Prénom', 'text'),
					array('nom', 'Nom', 'text'),
					array('id_role', 'Role', 'select', $roles),
					array('telephone', 'Téléphone', 'text'),
					array('mail', 'Adresse mail', 'text'),
					array('password', 'Mot de passe', 'password')
				)
			)
		);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /resource
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'prenom'=> 'required',
			'nom'	=> 'required',
			'telephone'	=> 'numeric|min:10|max:13',
			'id_role'	=> 'required|integer',
			'mail'	=> 'required|email|unique:users',
			'password'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('users/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$user = new User;
			$user->prenom = Input::get('prenom');
			$user->nom = Input::get('nom');
			$user->mail = Input::get('mail');
			$user->telephone = Input::get('telephone');
			$user->id_role = Input::get('id_role');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			Session::flash('message', 'Création réussie');
			Session::flash('alert', 'success');
			return Redirect::to('users');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /resource/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::all();

		$this->layout->content = View::make('layouts.edit')->with(
			array(
				'item' => $user,
				'items' => array(
					'users' => array(
						array('prenom', 'Prénom', 'text'),
						array('nom', 'Nom', 'text'),
						array('id_role', 'Role', 'select', $roles, $user->id_role),
						array('telephone', 'Téléphone', 'text'),
						array('mail', 'Adresse mail', 'text'),
						array('password', 'Mot de passe', 'password')
					)
				)
			)
		);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /resource/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'prenom'=> 'required',
			'nom'	=> 'required',
			'id_role'	=> 'required|integer',
			'telephone'	=> 'numeric|min:10|max:13',
			'mail'	=> 'required|email',
			'password'	=> ''
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$user = User::find($id);
			$user->prenom = Input::get('prenom');
			$user->nom = Input::get('nom');
			$user->mail = Input::get('mail');
			$user->telephone = Input::get('telephone');
			$user->id_role = Input::get('id_role');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			Session::flash('message', 'Mise à jour réussie');
			Session::flash('alert', 'success');
			return Redirect::to('users');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /resource/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		Session::flash('message', 'Suppression réussie');
		Session::flash('alert', 'success');
		return Redirect::to('users');
	}

	public function login()
	{
		$message = '';

		$rules = array(
			'mail' => 'required|email',
			'password' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			foreach ($errors as $k => $e) {
				if($k > 0) $message.='<br/>';
				$message.= $e;
			}
		} else {
			$user = array(
				'mail' => Input::get('mail'),
				'password' => Input::get('password')
			);

			if (Auth::attempt($user)) {
				// Utilisateur identifié
				Session::flash('message', 'Connexion réussie');
				Session::flash('alert', 'success');
				return Redirect::to('/');
			}

			// Les champs sont valides mais l'identification échoue
			$message.= 'L\'e-mail ou le mot de passe saisi est incorrect.';
		}

		Session::flash('message', $message);
		Session::flash('alert', 'danger');
		return Redirect::to('login')->withInput();
	}

}