<?php

class Room extends Eloquent {

	protected $fillable = array('name', 'seats');

	protected $guarded = array('id');

}