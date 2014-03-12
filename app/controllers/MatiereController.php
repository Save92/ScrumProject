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
		$formations = Formation::all();

		$this->layout->content = View::make('matiere.index')->with('matieres', $matieres);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('matiere.create');
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
			'id_thematique'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('matieres/create')
				->withErrors($validator);
		} else {
			$matiere = new Matiere;
			$matiere->libelle = Input::get('libelle');
			$matiere->id_thematique=1;
			$matiere->save();

			Session::flash('message', 'Successfully created');
			Session::flash('alert', 'success');
			return Redirect::to('matieres');
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
		$matiere = Matiere::find($id);

		$this->layout->content = View::make('matiere.show')->with('matiere', $matiere);
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
		
		// Il faudra récuperer les thématiques et les passer
		// Dans le with avec matiere

		$this->layout->content = View::make('matiere.edit')->with('matiere', $matiere);
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
			return Redirect::to('matieres/' . $id . '/edit')
				->withErrors($validator);
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
		$matiere = Formation::find($id);
		$matiere->delete();

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('matieres');
	}

}