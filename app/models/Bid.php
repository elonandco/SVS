<?php

class Bid extends Eloquent {

	protected $fillable = array( 'user_id', 'type', 'start_date', 'end_date', 'due_date', 'description', 'category_id' );
    protected $guarded = array('clean');

	public  $validation = array(
	   'start_date'				=> 'required|date',
	   'end_date'				=> 'required|date',
       'due_date'               => 'required|date',
	   'description'			=> 'required'
	);

    public function validate($data)
    {
       
        $v = Validator::make($data, $this->validation);
        
        return $v;
    }

	public function category()
    {
        return $this->belongsTo('Category');
    }

    public function vendors()
    {
        return $this->belongsToMany('Vendor')->withPivot('response','response_timestamp');
    }

    public function vendor($id)
    {
        return $this->belongsToMany('Vendor')->withPivot('response','response_timestamp')->where('bid_vendor.vendor_id',$id);
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function responses()
    {
    	return $this->belongsToMany('Vendor')->WhereNotNull('bid_vendor.response');
    }

    public function attachments()
    {
        return $this->morphMany('Attachment', 'imageable');
    }

    public function getDueAttribute()
    {
        return $this->due_date ? Carbon::createFromFormat('Y-m-d H:i:s', $this->due_date . ' 00:00:00') : null;
    }

    public function getExpiredAttribute()
    {
        return (strtotime($this->due_date) + (24*60*60)) < time() ? true : false;
    }

    public function getResponseAttribute()
    {
        return (count($this->pivot)) ? $this->pivot->response : null;
    }

    public function setStartDateAttribute($value) {
      $this->attributes['start_date'] = date('Y-m-d', strtotime($value) );
    }

    public function setEndDateAttribute($value) {
      $this->attributes['end_date'] = date('Y-m-d', strtotime($value) );
    }

    public function setDueDateAttribute($value) {
        
        $this->attributes['due_date'] = date('Y-m-d', strtotime($value) );
    }


}