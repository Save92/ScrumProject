<?php

class Classe extends Eloquent {
	
	protected $fillable = array('libelle','id_user','annee','id_formation');

	protected $guarded = array('id');

	public function getName() {
		return $this->libelle;
	}

	public function getYear() {
		return $this->annee;
	}

	public function getResponsable() {

		$formation = Formation::find($this->id_formation);

		$user = User::find($formation->id_user);

		return $user->getName();
	}

	public function getFormation() {
		$formation = Formation::find($this->id_formation);
		return $formation->getName();
	}

	public function getUsername() {
		$username = User::find($this->id_user)->getName();

		return $username;
	}

}