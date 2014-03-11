<?php

class Formation extends Eloquent {

	protected $fillable = array('libelle', 'annee', 'conditions', 'id_personne');

	protected $guarded = array('id');

}