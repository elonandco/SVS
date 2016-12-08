<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		if(Auth::id() && Auth::user()->hasRole('vendor')){
			$slug = Auth::user()->vendors->first()->slug;
			return Redirect::route('vendor_profile', array('slug' => $slug));
		} else {
			
			$categories = json_encode(array_pluck(Category::all(), 'name'));

			Assets::add('vendor-search');
			return View::make('pages.home')
				->with('categories', $categories);	
		}
		
	}

}
