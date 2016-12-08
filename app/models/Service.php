<?php

class Service extends Ardent {

	protected $fillable = array('name');

	protected $hidden = array('created_at', 'updated_at');

}