<?php

class Cours extends Eloquent {

	protected $fillable = array('start','end','id_user','id_salle','id_matiere');

	protected $guarded = array('id');

}