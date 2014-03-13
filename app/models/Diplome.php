<?php

class Diplome extends Eloquent {

	protected $fillable = array('libelle');

	protected $guarded = array('id');

	protected function getName() 
	{
		return $this->libelle;
	}
}