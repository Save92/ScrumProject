<?php

class Formation extends Eloquent {

	protected $fillable = array('libelle', 'annee', 'conditions', 'id_user');

	protected $guarded = array('id');

}