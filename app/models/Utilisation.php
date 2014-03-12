<?php

class Utilisation extends Eloquent {

	protected $fillable = array('id_salle','id_matiere');

	protected $guarded = array('id');

}