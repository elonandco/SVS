<?php

class Rating extends Ardent {


	public function scopeOrdered($query)
	{
	    return $query->orderBy('question_id', 'asc');
	}

	public function scopeWithQuestions($query)
	{
		return $query->join('questions', 'questions.id', '=', 'ratings.question_id');
	}

	public function review()
    {
        return $this->hasOne('Review');
    }

}