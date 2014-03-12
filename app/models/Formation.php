<?php

class Formation extends Eloquent {

	protected $table = 'formations';

	protected $fillable = array('libelle', 'annee', 'conditions', 'id_user');

	protected $guarded = array('id');

	/**
	 * Retourne le nom du responsable de la formation
	 *
	 */
	public function getUser()
	{
		$user = User::find($this->id_user);

		return $user->getName();
	}





}