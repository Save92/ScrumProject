<?php

class Role extends Eloquent {

	protected $table = 'roles';

	protected $fillable = array('libelle', 'id');

}