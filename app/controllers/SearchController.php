<?php

class SearchController extends Controller
{

	public function results()
	{

		Assets::add('vendor-search');
		return View::make('pages.search.results')
			->with('is_search', true);

	}

	public function search ()
	{

		$result = Vendor::search(
			Input::get('q'),
			Input::get('latitude'),
			Input::get('longitude'),
			Input::get('radius'),
			Input::get('cat'),
			Input::get('meta'),
			Input::get('offset')
		);

		return Response::json(array( 'success' => true, 'vendors' => $result['vendors'], 'count' => $result['count']));
	}

	public function categories()
	{
		$categories = Category::byRelevance(Input::get('q'));

		return Response::json( array( 'success' => true, 'categories' =>  $categories) ); 
	}

}