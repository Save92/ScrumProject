<?php

class ClasseController extends BaseController {

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
		$classes = Classe::all();

		$this->layout->content = View::make('classe.index')->with('classes', $classes);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new User;
		$users = $user->getByRole(4);

		$formations = Formation::all();
		$this->layout->content = View::make('layouts.create')->with(
			'items', array(
				'classes' => array(
					array('libelle', 'Libellé', 'text'),
					array('id_formation', 'Formation', 'select', $formations),
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
			'libelle'=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('classes/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$classe = new Classe;
			$classe->libelle = Input::get('libelle');
			$classe->id_user = Input::get('id_user');
			$classe->id_formation = Input::get('id_formation');
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
		$formation = Formation::where('id',$classe->id_formation)->pluck('libelle');
		$students = User::where('id_role',2)->get(array('prenom','nom'));

		// SELECT x,x,x,x,users.name
		// FROM classes
		// JOIN users ON classes.id_user = users.id
		// WHERE classes.id = $id

		// AND users.id_role = 2



		//var_dump($students);
		$this->layout->content = View::make('classe.show')->with(
			array(
				'classe' => $classe,
				'formation' => $formation,
				'students' => $students
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
		//var_dump($classe);

		$this->layout->content = View::make('layouts.edit')->with(
			array(
				'item' => $classe,
				'items' => array(
					'classes' => array(
						array('libelle', 'Libellé', 'text')
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
			'libelle'=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('classes/' . $id . '/edit')
				->withErrors($validator);
		} else {
			$classe = Classe::find($id);
			$classe->libelle = Input::get('libelle');
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
		$classe->delete();

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('classes');
	}

}