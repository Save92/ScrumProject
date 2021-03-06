<?php

class ThematiqueController extends BaseController {

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
		$thematiques = Thematique::all();

		$this->layout->content = View::make('thematique.index')->with('thematiques', $thematiques);
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
		$thematique = Thematique::find($id);

		$this->layout->content = View::make('thematique.show')->with('thematique', $thematique);
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
			'thematiques' => array(
				'libelle'	=> 'Libellé'
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
			'libelle'=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('thematiques/create')
				->withErrors($validator);
		} else {
			$thematique = new Thematique;
			$thematique->libelle = Input::get('libelle');
			$thematique->save();

			Session::flash('message', 'Successfully created');
			Session::flash('alert', 'success');
			return Redirect::to('thematiques');
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
		$thematique = Thematique::find($id);
		
		// Il faudra récuperer les thématiques et les passer
		// Dans le with avec matiere

		$this->layout->content = View::make('layouts.edit')->with(
					array(
						'item' => $thematique,
						'items' => array(
							'thematiques' => array(
								'libelle'	=> 'Libellé'
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
			'libelle'=> 'required',
			'id_thematique'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('thematiques/' . $id . '/edit')
				->withErrors($validator);
		} else {
			$thematique = Thematique::find($id);
			$thematique->libelle = Input::get('libelle');
			$thematique->save();

			Session::flash('message', 'Successfully updated');
			Session::flash('alert', 'success');
			return Redirect::to('thematiques');
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
		$thematique = Thematique::find($id);
		$thematique->delete();

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('matieres');
	}

}