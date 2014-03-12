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
		$this->layout->content = View::make('layouts.create')->with('items', array(
			'users' => array(
				'prenom'	=> 'Prénom',
				'nom'		=> 'Nom',
				'mail'		=> 'Adresse mail',
				'telephone'	=> 'Téléphone',
				'id_role'	=> 'Role'
			)
		));
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
			'mail'	=> 'required|email',
			'telephone'	=> 'required',
			'id_role'	=> 'required'
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
			$user->save();

			Session::flash('message', 'Successfully created');
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

		$this->layout->content = View::make('layouts.edit')->with(
			array(
				'item' => $user,
				'items' => array(
					'users' => array(
						'prenom'	=> 'Prénom',
						'nom'		=> 'Nom',
						'mail'		=> 'Adresse mail',
						'telephone'	=> 'Téléphone',
						'id_role'	=> 'Role'
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
			'mail'	=> 'required|email',
			'telephone'	=> 'required',
			'id_role'	=> 'required'
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
			$user->save();

			Session::flash('message', 'Successfully updated');
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

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('users');
	}

	public function login()
	{
		$rules = array(
			'mail' => 'required|email',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')->withErrors($validator);
		} else {
			$user = array(
				'mail' => Input::get('mail'),
				'password' => Input::get('password')
			);

			if (Auth::attempt($user)) {
				Session::flash('message', 'Successfully logged in');
				Session::flash('alert', 'success');
				return Redirect::to('/');
			}

			Session::flash('message', 'Incorrect username/password combination');
			Session::flash('alert', 'error');
			return Redirect::to('login');
		}
	}

}