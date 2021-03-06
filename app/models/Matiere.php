<?php

class Matiere extends Eloquent {

	protected $fillable = array('libelle', 'id_thematique', 'coef'); // composition ??

	protected $guarded = array('id');

	public function getName()
	{
		return $this->libelle;
	}

	public function getThematique()
	{
		$thematique = Thematique::find($this->id_thematique)->libelle;

		return $thematique;
	}

	public function getCoef()
	{
		return $this->coef;
	}

}