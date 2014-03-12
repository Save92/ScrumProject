<?php

class FormationController extends BaseController {

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
		$formations = Formation::all();

		$this->layout->content = View::make('formation.index')->with('formations', $formations);
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
		$formation = Formation::find($id);

		$this->layout->content = View::make('formation.show')->with('formation', $formation);
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
			'formations' => array(
				'libelle'	=> 'Libellé',
				'annee'		=> 'Année',
				'conditions'=> 'Conditions',
				'id_user'	=> 'Secrétaire pédagogique'
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
			'libelle'=> 'required',
			'annee'	=> 'required',
			'conditions' => 'required',
			'id_user' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('formations/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$formation = new Formation;
			$formation->libelle = Input::get('libelle');
			$formation->annee = Input::get('annee');
			$formation->conditions = Input::get('conditions');
			$formation->id_user = Input::get('id_user');
			$formation->save();

			Session::flash('message', 'Successfully created');
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

		$this->layout->content = View::make('layouts.edit')->with(
			array(
				'item' => $formation,
				'items' => array(
					'formations' => array(
						'libelle'	=> 'Libellé',
						'annee'		=> 'Année',
						'conditions'=> 'Conditions',
						'id_user'	=> 'Secrétaire pédagogique'
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
			'annee'	=> 'required',
			'conditions' => 'required',
			'id_user' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('formations/' . $id . '/edit')
				->withErrors($validator);
		} else {
			$formation = Formation::find($id);
			$formation->libelle = Input::get('libelle');
			$formation->annee = Input::get('annee');
			$formation->conditions = Input::get('conditions');
			$formation->id_user = Input::get('id_user');
			$formation->save();

			Session::flash('message', 'Successfully updated');
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
		$formation->delete();

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('formations');
	}

}