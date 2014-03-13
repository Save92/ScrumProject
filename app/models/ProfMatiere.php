<?php

class ProfMatiere extends Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'prof_matieres';

	protected $fillable = array('id_user','id_matiere');

	protected $guarded = array('id');

	protected function getMatiere()
	{
		$matiere = Matiere::find($this->id_matiere);
		return $matiere->getName();
	}

	protected function getUser()
	{
		$user = User::find($this->id_user);
		return $user;
	}
}