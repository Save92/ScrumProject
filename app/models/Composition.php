<?php

class Composition extends Eloquent {

	protected $fillable = array('coef','id_matiere','id_formation');

	protected $guarded = array('id');

}