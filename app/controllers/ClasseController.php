<?php

class ClasseController extends BaseController {

	private $classes;

	public function __construct()
	{
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
		// Récupération des classes
		$classes =array();
		$actions = array(0,0,0,0);
		// (créer, afficher, modifier, supprimer)
		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				$classes = Classe::all()->groupBy('libelle');
				break;
			case 4:
				$actions = array(1,1,1,0);
																	//	$formations = Formation::where('id_user', Auth::user()->id)->get();
				$classes = Classe::all()->groupBy('libelle');
				break;
			default:
				//$actions = array(0,1,0,0);
				// Redirection si la route n'est pas censée être accessible
				$this->deny();
				break;
		}

		$this->layout->content = View::make('layouts.table')->with(
			array(
				'items' => $classes,
				'name' => 'Classes',
				'route' => 'classes',
				'actions' => $actions,
				'fields' => array(
					'Nom' => 'getName',
					'Responsable' => 'getResponsable',
					'Formation' => 'getFormation',
					'Année' => 'getYear'
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

		$annees = array(
			'2014/2015' => '2014 - 2015',
			'2015/2016' => '2015 - 2016',
			'2016/2017' => '2016 - 2017',
			'2017/2018' => '2017 - 2018'
		);

		$users = User::where('id_role',1)->get();

		$formations = Formation::all();

		switch (Session::get('role')) {
			case 5:
				$items = array(
					array('libelle', 'Libellé', 'text'),
					array('id_user', 'Etudiant', 'select', $users),
					array('id_formation', 'Formation', 'select', $formations),
					array('annee', 'Année', 'select', $annees)
				);
				break;
			case 4:
				$items = array(
					array('libelle', 'Libellé', 'text'),
					array('id_user', 'Etudiant', 'select', $users),
					array('id_formation', 'Formation', 'select', $formations),
					array('annee', 'Année', 'select', $annees)
				);
				break;
			default:
				$this->deny();
				return Redirect::to('/');
				break;
		}

		$this->layout->content = View::make('layouts.create')->with(
			array(
				'name' => 'Classes',
				'route' => 'classes',
				'items' => $items
			)
		);
	}

	/**
	 * Show the form for assign a new user (role 2) to the class.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function add($value='') {

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
			'libelle'=> 'required',
			'id_user' => 'required|integer',
			'id_formation' => 'required|integer',
			'annee' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$this->sendErrors($validator);
			return Redirect::to('classes/create')->withInput();
		} else {
			$classe = new Classe;
			$classe->libelle = Input::get('libelle');
			$classe->id_user = Input::get('id_user');
			$classe->id_formation = Input::get('id_formation');
			$classe->annee = Input::get('annee');
			$classe->save();

			Session::flash('message', 'Successfully created');
			Session::flash('alert', 'success');
			return Redirect::to('classes');
		}
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

		$classe = Classe::find($id);

		$classes = Classe::where('libelle', $classe->libelle)->get();

		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				break;
			case 4:
				$actions = array(1,1,1,0);
				break;
			default:

		$actions = array(0,0,0,0);
				//$actions = array(0,1,0,0);
				// Redirection si la route n'est pas censée être accessible
				$this->deny();
				break;
		}


		$this->layout->content = View::make('classe.show')->with(
			array(
				'classe' => $classe,
				'items' => $classes,
				'name' => 'Etudiants',
				'route' => 'users',
				'actions' => $actions,
				'fields' => array(
					'Nom' => 'getUsername'
				)
			)
		);
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
		$classe = Classe::find($id);
		$formations = Formation::all();

		$annees = array(
			'2014/2015' => '2014 - 2015',
			'2015/2016' => '2015 - 2016',
			'2016/2017' => '2016 - 2017',
			'2017/2018' => '2017 - 2018'
		);

		// var_dump(Session::get('role')); die();
		switch (Session::get('role')) {
			case 5:
				$items = array(
					array('libelle', 'Libellé', 'text')
				);
				break;
			case 4:
				$items = array(
					array('libelle', 'Libellé', 'text')
				);
			default:
				/*$items = array(
					array('libelle', 'Libellé', 'text', false),
					array('conditions', 'Conditions', 'text', false),
					array('id_user', 'Secrétaire pédagogique', 'select', $users, $formation->id_user),
					array('id_diplome', 'Diplome', 'select', $diplomes, $formation->id_diplome)
				);*/
				break;
		}

		$this->layout->content = View::make('layouts.edit')->with(
			array(
				'name' => 'Classes',
				'route' => 'classes',
				'item' => $classe,
				'items' => $items
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
			'libelle'=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$this->sendErrors($validator);
			return Redirect::to('classes/' . $id . '/edit')->withInput();
		} else {
			$classe = Classe::find($id);
			$classe->libelle = Input::get('libelle');
			$classe->annee = Input::get('annee');
			$classe->save();

			Session::flash('message', 'Successfully updated');
			Session::flash('alert', 'success');
			return Redirect::to('classes');
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
		$classe = Classe::find($id);

		$this->tryDelete($classe);

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('classes');
	}

}