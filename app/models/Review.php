<?php

class Review extends Ardent {

	public function scopeOrdered($query)
	{
	    return $query->orderBy('created_at', 'desc');
	}


	public function averageRating()
	{
		$result = $this->join('ratings','ratings.review_id','=','reviews.id')
		    ->select(DB::raw('avg(ratings.rating) as avg_rating'))
		    ->groupBy('reviews.id')
		    ->where('reviews.id',$this->id)
		    ->first();

		return round($result->avg_rating);
	}

	public function user()
	{
		return $this->belongsTo('User');
	}


	public function ratings()
    {
        return $this->hasMany('Rating')->withQuestions()->ordered();
    }

}