<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    public $fillable = array('first_name', 'last_name', 'email');

    protected $hidden = array('password');

    public function vendors()
    {
        return $this->hasMany('Vendor');
    }

    public function getSlugAttribute($value='')
    {
        return $this->vendors()->first()->slug;
    }

    public function bids()
    {
         return $this->hasMany('Bid')->orderBy('updated_at', 'desc');
    }

    public function activeBids()
    {
        return $this->bids()->where('active',true);
    }

    public function pendingBid($value='')
    {
        $bid = $this->bids()->where('active',false)->first();
         

        if(!$bid){
            $bid = new Bid();
            Session::flash('new_bid', true);
            $this->hasMany('Bid')->save($bid);
        }

        return $bid;
    }

    public function getAvatarAttribute($value)
    {
        if($value){
            return $value;
        } else {
            return '/assets/images/common/user-default.png';    
        }
    	
    }

}
