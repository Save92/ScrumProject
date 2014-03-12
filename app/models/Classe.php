<?php

class Classe extends Eloquent {
	protected $fillable = array('libelle', 'id_user', 'id_formation');

	protected $guarded = array('id');

}