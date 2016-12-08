<?php

class Category extends Ardent {

	protected $fillable = array('name');

	public $timestamps = false;

	protected $hidden = array('pivot');

	public function scopeOrdered($query)
	{
	    return $query->orderBy('name', 'asc')->get();
	}

	public static function byRelevance($q)
	{
		
		$similar = Searchy::categories('name')->query($q);
		$remain = self::whereNotIn('id', array_merge(array('0'), $similar->lists('id')))->get();
		$merged = array_merge( $similar->get(), $remain->toArray());
		return $merged;
	}

}