<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Room extends Eloquent {

	protected $fillable = array('name', 'seats');

	protected $guarded = array('id');

}