<?php

class Reservation extends Eloquent {

	protected $fillable = array('start','end','id_user','id_materiel');

	protected $guarded = array('id');

}