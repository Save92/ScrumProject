<?php

class MatiereController extends BaseController {

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
		$matieres = Matiere::all();

		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				break;
			case 4:
				$actions = array(0,1,0,0);
				break;
			default:
				//$actions = array(0,1,0,0);
				// Redirection si la route n'est pas censée être accessible
				$this->deny();
				break;
		}

		$this->layout->content = View::make('layouts.table')->with(
			array(
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
		$formations = Formation::all();

		$thematiques = Thematique::all();

		$this->layout->content = View::make('layouts.create')->with(
			array(
				'name' => 'Matières',
				'route' => 'matieres',
				'items' => array(
					array('libelle', 'Libellé', 'text'),
					array('id_formation', 'Formation', 'select', $formations),
					array('id_thematique', 'Thématique', 'select', $thematiques)
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
			'id_formation' => 'required',
			'id_thematique'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
						$this->sendErrors($validator);

			return Redirect::to('matieres/create')->withInput();
		} else {
			$matiere = new Matiere;
			$matiere->libelle = Input::get('libelle');
			$matiere->id_formation = Input::get('id_formation');
			$matiere->id_thematique=Input::get('id_thematique');
			$matiere->save();

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
			'id_thematique'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			$this->sendErrors($validator);

			return Redirect::to('matieres/' . $id . '/edit')->withInput();
		} else {
			$matiere = Matiere::find($id);
			$matiere->libelle = Input::get('libelle');
			$matiere->id_thematique = Input::get('id_thematique');
			$matiere->save();

			Session::flash('message', 'Successfully updated');
			Session::flash('alert', 'success');
			return Redirect::to('matieres');
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
		$matiere = Matiere::find($id);

		$this->tryDelete($matiere);

		return Redirect::to('matieres');
	}

}