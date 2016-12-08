<?php

class Attachment extends Eloquent {

	protected $fillable = array( 'path', 'filename' );

    public function imageable()
    {
        return $this->morphTo();
    }

}