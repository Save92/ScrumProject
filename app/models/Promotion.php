<?php

class Promotion extends Eloquent {

	protected $fillable = array('libelle', 'id_diplome');

	protected $guarded = array('id');

}