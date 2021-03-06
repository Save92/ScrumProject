<?php

class UserController extends BaseController {

	/*public function __construct()
	{
		$this->beforeFilter('auth', array('except' => 'login'));
	}*/

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

		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				break;
			default:
				$actions = array(0,0,0,0);
				// Fallback si la route n'est pas bloquée
				$this->deny();
				return Redirect::to('/');
				break;
		}

		$this->layout->content = View::make('layouts.table')->with(
			array(
				'items' => $users,
				'name' => 'Utilisateurs',
				'route' => 'users',
				'actions' => $actions, // (créer, afficher, modifier, supprimer)
				'fields' => array(
					// Contient le nom du champ et le nom de la fonction (models) qui renvoie la valeur
					'Nom' => 'getName',
					'Adresse mail' => 'getMail',
					'Téléphone' => 'getPhone',
					'Role' => 'getRole'
				)
			)
		);
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

		$items = false;
		$name = false;
		$route = false;

		// Secrétaire
		if ($user->id_role == 4) {

			$name = 'Classes';
			$route = 'classes';

			$items = array();
			$formation = Formation::where('id_user', $user->id)->get();
			foreach ($formation as $f) {

				$classes = Classe::where('id_formation', $f->id)->get();
				array_push($items, $classes);

			}
		// Prof
		} else if ($user->id_role == 3) {

			$name = 'Matières';
			$route = 'matieres';

			$items = array();
			$profmatieres = ProfMatiere::where('id_user', $user->id)->get();
			foreach ($profmatieres as $pm) {

				array_push($items, Matiere::where('id', $pm->id_matiere)->get());

			}
		}

		$this->layout->content = View::make('user.show')->with(
			array(
				'item' => $user,
				'items' => $items,
				'name' => $name,
				'route' => $route,
				//'actions' => $actions,
				'fields' => array(
					'Libellé' => 'getName',
					'Coefficient' => 'getCoef',
					'Thématique' => 'getThematique'
				)
			)
		);
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
			array(
				'name' => 'Utilisateurs',
				'route' => 'users',
				'items' => array(
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
	 * Show the form for creating a new resource.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function createprof()
	{
		$matieres = Matiere::all();
		$idProf = Session::get('prof');
		$prof = User::find($idProf);

		$this->layout->content = View::make('layouts.create')->with(
			array(
				'name' => 'Matières',
				'route' => 'storeprof',
				'items' => array(
					array('id_user', 'Professeur', 'text', $prof->getName()),
					array('matieres', 'Matières', 'select', $matieres),
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
	public function storeprof()
	{
		$rules = array(
			'id_user'=> 'required',
			'id_matiere' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$this->sendErrors($validator);
			return Redirect::to('users/create')->withInput();
		} else {
			$prof = new ProfMatiere;
			$prof->id_user = Input::get('id_user');
			$prof->id_user = Input::get('id_matiere');
			$prof->save();

			Session::flash('message', 'Création réussie');
			Session::flash('alert', 'success');

			return Redirect::to('users');
		}
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
			'telephone'	=> 'numeric',
			'id_role'	=> 'required|integer',
			'mail'	=> 'required|email|unique:users',
			'password'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$this->sendErrors($validator);
			return Redirect::to('users/create')->withInput(Input::except('password'));
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

			if($user->id_role == 3) {
				Session::flash('prof', $user->id);
				return Redirect::to('profs/create');
			}


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
				'name' => 'Utilisateurs',
				'route' => 'users',
				'item' => $user,
				'items' => array(
					array('prenom', 'Prénom', 'text'),
					array('nom', 'Nom', 'text'),
					array('id_role', 'Role', 'select', $roles, $user->id_role),
					array('telephone', 'Téléphone', 'text'),
					array('mail', 'Adresse mail', 'text'),
					array('password', 'Mot de passe', 'password')
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
			'telephone'	=> 'numeric',
			'mail'	=> 'required|email',
			'password'	=> ''
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$this->sendErrors($validator);
			return Redirect::to('users/' . $id . '/edit')->withInput(Input::except('password'));
		} else {
			$user = User::find($id);
			$user->prenom = Input::get('prenom');
			$user->nom = Input::get('nom');
			$user->mail = Input::get('mail');
			$user->telephone = Input::get('telephone');
			$user->id_role = Input::get('id_role');
			$pw = Input::get('password');
			if (!empty($pw)) {
				$user->password = Hash::make(Input::get('password'));
			}
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

		$this->tryDelete($user);

		return Redirect::to('users');
	}

	/**
	 * Authentification
	 * POST /login
	 *
	 * @return Response
	 */
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
			$message.= 'Le mail ou le mot de passe saisi est incorrect.';
		}

		Session::flash('message', $message);
		Session::flash('alert', 'danger');
		return Redirect::to('login')->withInput();
	}

}