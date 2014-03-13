<?php

class FormationController extends BaseController {

	protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 * GET /
	 *
	 * @return Response
	 */
	public function index()
	{
		$formations =array();
		$actions = array(0,0,0,0);
		// (créer, afficher, modifier, supprimer)
		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				$formations = Formation::all();
				break;
			case 4:
				$actions = array(1,1,1,0);
				$formations = Formation::where('id_user', Auth::user()->id)->get();
				break;
			default:
				//$actions = array(0,1,0,0);
				// Redirection si la route n'est pas censée être accessible
				$this->deny();
				break;
		}

		$this->layout->content = View::make('layouts.table')->with(
			array(
				'items' => $formations,
				'name' => 'Formations',
				'route' => 'formations',
				'actions' => $actions,
				'fields' => array(
					// Contient le nom du champ et le nom de la fonction (models) qui renvoie la valeur
					'Nom' => 'getName',
					'Responsable' => 'getUser',
					'Diplome' => 'getDiplome',
					'Conditions' => 'getTerms'
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
		$matieres = Matiere::all();

		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				break;
			case 4:
				$actions = array(1,1,1,0);
				break;
			default:
			

		$formation =array();
		$actions = array(0,0,0,0);
				//$actions = array(0,1,0,0);
				// Redirection si la route n'est pas censée être accessible
				$this->deny();
				break;
		}

		$formation = Formation::find($id);

		$this->layout->content = View::make('formation.show')->with(
			array(
				'formation' => $formation,
				'items' => $matieres,
				'name' => 'Matières',
				'route' => 'matieres',
				'actions' => $actions,
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
		// Récupération de tous les secrétaires pédagogiques
		$users = User::where('id_role', 4)->get();

		$diplomes = Diplome::all();

		$this->layout->content = View::make('layouts.create')->with(
			array(
				'name' => 'Formations',
				'route' => 'formations',
				'items' => array(
					array('libelle', 'Libellé', 'text'),
					array('conditions', 'Conditions', 'text'),
					array('id_diplome', 'Diplome', 'select', $diplomes),
					array('id_user', 'Secrétaire pédagogique', 'select', $users)
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
			'libelle'=> 'required',
			'conditions' => 'required',
			'id_user' => 'required|integer',
			'id_diplome' => 'required|integer'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$this->sendErrors($validator);

			return Redirect::to('formations/create')->withInput();
		} else {
			$formation = new Formation;
			$formation->libelle = Input::get('libelle');
			$formation->conditions = Input::get('conditions');
			$formation->id_diplome = Input::get('id_diplome');
			$formation->id_user = Input::get('id_user');
			$formation->id_diplome = Input::get('id_diplome');
			$formation->save();

			Session::flash('message', 'Création réussie');
			Session::flash('alert', 'success');
			return Redirect::to('formations');
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
		$formation = Formation::find($id);

		$users = User::where('id_role', 4)->get();

		$diplomes = Diplome::all();

		switch (Session::get('role')) {
			case 5:
				$items = array(
					array('libelle', 'Libellé', 'text'),
					array('conditions', 'Conditions', 'text'),
					array('id_user', 'Secrétaire pédagogique', 'select', $users, $formation->id_user),
					array('id_diplome', 'Diplome', 'select', $diplomes, $formation->id_diplome)
				);
				break;
			case 4:
				$items = array(
					array('libelle', 'Libellé', 'text', false),
					array('conditions', 'Conditions', 'text'),
					array('id_user', 'Secrétaire pédagogique', 'select', $users, $formation->id_user),
					array('id_diplome', 'Diplome', 'select', $diplomes, $formation->id_diplome)
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
				'name' => 'Formations',
				'route' => 'formations',
				'item' => $formation,
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
			'libelle'=> 'required',
			'conditions' => 'required',
			'id_user' => 'required|integer',
			'id_diplome' => 'required|integer'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$this->sendErrors($validator);

			return Redirect::to('formations/' . $id . '/edit')->withInput();
		} else {
			$formation = Formation::find($id);
			$formation->libelle = Input::get('libelle');
			$formation->conditions = Input::get('conditions');
			$formation->id_diplome = Input::get('id_diplome');
			$formation->id_user = Input::get('id_user');
			$formation->id_diplome = Input::get('id_diplome');
			$formation->save();

			Session::flash('message', 'Mise à jour réussie');
			Session::flash('alert', 'success');
			return Redirect::to('formations');
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
		$formation = Formation::find($id);

		$this->tryDelete($formation);

		return Redirect::to('formations');
	}

}