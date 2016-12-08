<?php

class Vendor extends Ardent {

	protected $fillable = array('name', 'owner', 'phone', 'email', 'url', 'description', 'address', 'city', 'state', 'zip');

    protected $hidden = array('created_at','updated_at');

	public static $rules = array(
        'name' => 'required|min:3'
    );


    public static function getBySlug($slug)
    {
      return self::where('slug',$slug)->firstOrFail();
    }

    public static function getByIds($ids)
    {
        return self::whereIn('id', $ids)
            ->with(['user' => function($query){ $query->addSelect('id', 'avatar'); }])
            ->get(['vendors.id', 'vendors.user_id', 'vendors.name', 'vendors.slug']);
    }

	public function user()
    {
        return $this->belongsTo('User');
    }

    public function categories()
    {
        return $this->belongsToMany('Category')->withPivot('primary');
    }

    public function certifications()
    {
    	 return $this->hasMany('Certification');
    }

    public function documents()
    {
         return $this->hasMany('Document');
    }

    public function projects()
    {
         return $this->hasMany('Project');
    }

    public function reviews()
    {
         return $this->hasMany('Review');
    }

    public function visits()
    {
         return $this->hasMany('Visit');
    }

    public function services()
    {
        return $this->belongsToMany('Service');
    }

    public function bids()
    {
        return $this->belongsToMany('Bid')->withPivot('response')->orderBy('created_at', 'desc');
    }

    public function activeBids()
    {
        return $this->bids()->where('active',true);
    }

    public function getBidResponseAttribute()
    {
       return (count($this->pivot)) ? $this->pivot->response : null;
    }

    public function getBidResponseTimestampAttribute()
    {
       return (count($this->pivot)) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->response_timestamp) : null;
    }

    public function getRecentVisitsCountAttribute()
    {
        return $this->getRecentVisitsAttribute()->count();
    }

    public function getRecentVisitsAttribute()
    {
        return $this->hasMany('Visit')
                ->with('user')
                ->whereBetween('updated_at', array(
                    Carbon::now()->subWeek(), 
                    Carbon::now()));
    }

    public static function search($q,$lat,$long,$range=25,$cats=false,$meta=false, $offset=0, $perpage=20)
    {

        $range = $range ? $range : 25;

        $zips = DB::table('zip_codes')
          ->rememberForever()
          ->selectRaw("*, WGS84distance($lat, $long, `Latitude`, `Longitude`) * 3958.756 AS distance")
          ->having('distance', '<=', $range)
          ->having('distance', '>=', 0)
          ->get();

        $catresults = Searchy::categories('name')->query($q)->get();
        
        $zipsArr = array('0');
        $meta = $meta ? explode(',', $meta) : $meta;

        if($cats){
           $catsArr = explode(',', $cats);
        } else {
          $catsArr = array('0');  
        }
        
        foreach ($zips as $key => $value) {
           $zipsArr[] = $value->ZIPCode;
        }

        foreach ($catresults as $cat) {
           $catsArr[] = $cat->id;
        }
       
        $vendorsResult = self::join('category_vendor', 'vendors.id', '=', 'category_vendor.vendor_id')
            ->with(array( 
                'categories' => function($query){ $query->addSelect(array('name'))->where('primary', '=', 1); }, 
                'user' => function ($query){  $query->addSelect(array('id', 'avatar')); },
                'documents' => function ($query){  $query->addSelect(array('vendor_id', 'name')); }
            ) )
            ->whereIn('category_vendor.category_id',$catsArr)
            ->whereIn('zip', $zipsArr);

       
        /* Check if vendor has all of its documents */
        if(count($meta)){
            foreach($meta as $name){
                $vendorsResult->whereHas('documents', function($q) use ($name){
                    $q->where('name', $name);
                });
            }
        }
            
        $count = $vendorsResult->count();

        $vendors = $vendorsResult->take($perpage)
            ->skip($offset)
            ->get(['vendors.id', 'vendors.user_id', 'vendors.name', 'vendors.city', 'vendors.state', 'vendors.slug']);

        foreach ($vendors as $vendor) {
            $vendor->reviews = $vendor->breakdown(false);
        }

        return array('count'=> $count, 'vendors' => $vendors);
    }


    public function breakdown($counts = true)
    {
        $total = 0;
        $data = new stdClass();
        $temp_counts = array();
    

        $results = $this->reviews()
            ->join('ratings','ratings.review_id','=','reviews.id')
            ->select(DB::raw('avg(ratings.rating) as avg_rating'))
            ->groupBy('reviews.id')->get();

        foreach ($results as $rating) {
            $total += $rating->avg_rating;
            array_push($temp_counts, intval(round($rating->avg_rating)));
        }

        //Get the total number of reviews and average review
        $data->total = count($results);
        $data->rating = count($results) ? round($total/count($results)) : 0;

        //Generate the breakdown percentages
        if($counts){

            $temp_counts = array_count_values($temp_counts);
            $data->counts = array();

            for ($i=1; $i <= 7; $i++) { 
                    $data->counts[$i] = array(
                        'count' =>  isset($temp_counts[$i]) ? $temp_counts[$i] : 0,
                        'value' =>  isset($temp_counts[$i]) ? ($temp_counts[$i]/$data->total) * 100 : 0,
                    );
            }

        }
        
        

        return $data;
    }


}