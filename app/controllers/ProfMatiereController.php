<?php

class ProfMatiereController extends BaseController {

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
		$profmatiere = Profmatiere::all();

				$actions = array(0,0,0,0);
		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				break;
			default:

				$actions = array(0,1,0,0);
				//$actions = array(0,1,0,0);
				// Redirection si la route n'est pas censée être accessible
				$this->deny();
				break;
		}

		$this->layout->content = View::make('layouts.table')->with(
			array(
				'items' => $profmatiere,
				'name' => 'Matières',
				'route' => 'profmatiere',
				'actions' => $actions,
				'fields' => array(
					'id_user' => 'getUser',
					'id_matiere' => 'getCoef'
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
		$matiere = Matiere::find($id);

		$this->layout->content = View::make('matiere.show')->with(
				array(
						'matiere' => $matiere,
						'name' => 'Matières',
						'route' => 'matieres',
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
		$profId=Session::get('prof');
		$user = User::find($profId);

		$matieres = Matiere::all();

		$this->layout->content = View::make('layouts.create')->with(
			array(
				'name' => 'Matières',
				'route' => 'profs',
				'items' => array(
					array('id_user', 'Professeur', 'readonly', $user),
					array('matieres', 'Matières', 'checkbox', $matieres)
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
			'id_user' => 'required',
			'id_matiere'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
						$this->sendErrors($validator);

			return Redirect::to('profs/create')->withInput();
		} else {
			$profmatiere = new Profmatiere;
			$profmatiere->id_user = Input::get('id_user');
			$profmatiere->id_matiere= Input::get('id_matiere');
			$profmatiere->save();

			Session::flash('message', 'Successfully created');
			Session::flash('alert', 'success');
			return Redirect::to('matieres');
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
		$matiere = Matiere::find($id);
		$formations = Formation::all();
		$thematiques = Thematique::all();

		$this->layout->content = View::make('layouts.edit')->with(
			array(
				'name' => 'Matières',
				'route' => 'matieres',
				'item' => $matiere,
				'items' => array(
					array('libelle', 'Libellé', 'text'),
					array('id_formation', 'Formations', 'select', $formations, $matiere->id_formation),
					array('id_thematique', 'Thématique', 'select', $thematiques, $matiere->id_thematique)
				)
			)
		);
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
		$matiere = Matiere::find($id);

		$this->tryDelete($matiere);

		return Redirect::to('matieres');
	}

}