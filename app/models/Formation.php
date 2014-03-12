<?php

class Formation extends Eloquent {

	protected $table = 'formations';

	protected $fillable = array('libelle', 'conditions', 'id_user');

	protected $guarded = array('id');

	/**
	 * Retourne le nom de la formation
	 *
	 */

	public function getName()
	{
		return $this->libelle;
	}

	/**
	 * Retourne le nom du responsable de la formation
	 *
	 */
	public function getUser()
	{
		$user = User::find($this->id_user);

		return $user->getName();
	}

	/**
	 * Retourne les conditions
	 *
	 */

	public function getTerms()
	{
		return $this->conditions;
	}

}