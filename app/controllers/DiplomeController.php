<?php

class DiplomeController extends BaseController {

	

	protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 * GET /
	 *
	 * @return Response
	 */
	public function index()
	{


		// Gestion en fonction du role
		switch (Session::get('role')) {
			case 5:
				$actions = array(1,1,1,1);
				$diplomes = Diplome::all();
				break;
			default:
				$this->deny();
				break;
		}

		$this->layout->content = View::make('layouts.table')->with(
			array(
				'items' => $diplomes,
				'name' => 'Diplomes',
				'route' => 'diplomes',
				'actions' => $actions,
				'fields' => array(
					// Contient le nom du champ et le nom de la fonction (models) qui renvoie la valeur
					'Nom' => 'getName'
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
		$diplome = Diplome::find($id);

		$this->layout->content = View::make('diplome.show')->with('diplome', $diplome);
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
			'diplomes' => array(
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
			return Redirect::to('diplomes/create')
				->withErrors($validator);
		} else {
			$diplome = new Diplome;
			$diplome->libelle = Input::get('libelle');
			$diplome->save();

			Session::flash('message', 'Successfully created');
			Session::flash('alert', 'success');
			return Redirect::to('diplomes');
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
		$diplome = Diplome::find($id);
		
		// Il faudra récuperer les thématiques et les passer
		// Dans le with avec matiere

		$this->layout->content = View::make('layouts.edit')->with(
					array(
						'item' => $diplome,
						'items' => array(
							'diplomes' => array(
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
			'libelle'=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('diplomes/' . $id . '/edit')
				->withErrors($validator);
		} else {
			$diplome = Diplome::find($id);
			$diplome->libelle = Input::get('libelle');
			$diplome->save();

			Session::flash('message', 'Successfully updated');
			Session::flash('alert', 'success');
			return Redirect::to('diplomes');
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
		$diplome = diplome::find($id);
		$diplome->delete();

		Session::flash('message', 'Successfully deleted');
		Session::flash('alert', 'success');
		return Redirect::to('diplomes');
	}

}