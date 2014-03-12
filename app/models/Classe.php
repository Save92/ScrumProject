<?php

class Classe extends Eloquent {
	protected $fillable = array('libelle', 'annee','id_user', 'id_formation');

	protected $guarded = array('id');

}