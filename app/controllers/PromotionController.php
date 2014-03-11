<?php

class PromotionController extends BaseController {

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
		$promotions = Promotion::all();

		$this->layout->content = View::make('promotion.index')->with('promotions', $promotions);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /resource/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('promotion.create');
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
			'id_diplome' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('promotions/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$promotion = new Formation;
			$promotion->libelle = Input::get('libelle');
			$promotion->id_diplome = Input::get('id_diplome');
			$promotion->save();

			Session::flash('message', 'Successfully created');
			Session::flash('alert', 'success');
			return Redirect::to('promotions');
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
		$promotion = Formation::find($id);

		$this->layout->content = View::make('promotion.show')->with('promotion', $promotion);
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
		$promotion = Formation::find($id);

		$this->layout->content = View::make('promotion.edit')->with('promotion', $promotion);
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
			'id_diplome' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('promotions/' . $id . '/edit')
				->withErrors($validator);
		} else {
			$promotion = Formation::find($id);
			$formation->libelle = Input::get('libelle');
			$formation->id_diplome = Input::get('id_diplome');
			$formation->save();

			Session::flash('message', 'Successfully updated');
			Session::flash('alert', 'success');
			return Redirect::to('promotions');
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
		return Redirect::to('promotions');
	}

}