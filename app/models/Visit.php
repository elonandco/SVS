<?php

class Visit extends Ardent {

	protected $fillable = array('vendor_id', 'user_id');

	public function user()
    {
        return $this->belongsTo('User');
    }

	/**
	 * Registers a view on a vendor
	 */
	static public function register($vendor_id, $user)
	{

		if($user->hasRole("user")){
			$visit = self::firstOrNew(array(
				'vendor_id' => $vendor_id,
				'user_id' => $user->id
			));

			$visit->touch();
		}

		

	}

}