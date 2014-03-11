<?php

class Matiere extends Eloquent {

	protected $fillable = array('libelle', 'id_thematique');

	protected $guarded = array('id');

}