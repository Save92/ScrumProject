<?php

class Formation extends Eloquent {

	protected $table = 'formations';

	protected $fillable = array('libelle', 'conditions', 'id_user', 'id_diplome');

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
	 * Retourne le nom du diplome
	 *
	 */
	public function getDiplome()
	{
		$diplome = Diplome::find($this->id_diplome)->libelle;

		return $diplome;
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