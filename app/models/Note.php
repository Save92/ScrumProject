<?php

class Note extends Eloquent {

	protected $fillable = array('valeur','id_user','id_formation','id_matiere');

	protected $guarded = array('id');

}