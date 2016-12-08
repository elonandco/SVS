<?php

use Illuminate\Support\MessageBag;

class BidsController extends BaseController {

	public function __construct() {
		if(Auth::user()){
			$this->vendor = Vendor::with(array('user','services'))->where('user_id',Auth::id())->firstOrFail();
			$this->isVendor = Auth::user()->hasRole('vendor');
		}
	}

	public function index()
	{
		if($this->isVendor){
			$bids = $this->vendor->activeBids()->get();
		} else {
			$bids = Auth::user()->activeBids()->get();	
		}
		
		

		return View::make('pages.bids.listing')
			->with('vendor', $this->vendor)
			->with('bids', $bids)
			->with('isVendor', $this->isVendor);
		
	}

	public function create()
	{

		Assets::add('bid-creation');

		$categories = Category::ordered()->lists('name', 'id');

		$vendorsList = Session::get('bid.vendors', function() { return array(); });
		$vendors = count($vendorsList) ? Vendor::getByIds(Session::get('bid.vendors')) : [];
		$bid = Auth::user()->pendingBid();

		return View::make('pages.bids.create')
			->with('bid', $bid)
			->with('vendors', $vendors)
			->with('vendor', $this->vendor)
			->with('isVendor', $this->isVendor)
			->with('isOwner', false)
			->with('categories', $categories);

	}

	public function doUpload($bid_id)
	{
		// TODO Validate
		$user = Auth::user();
		$file = Input::file('file');
		$bid = Bid::find($bid_id);
		
		$publicFolder = '/uploads/attachments';
		$destinationPath = public_path() . $publicFolder;
		$filename = md5(time() . $user->id . $file->getClientOriginalName()) . '.' .$file->getClientOriginalExtension();
		
		if($file->move($destinationPath, $filename)){
			
			$attachment = new Attachment(array(
				'path' => $publicFolder . '/' . $filename,
				'filename' => $file->getClientOriginalName()
			));

			$bid->attachments()->save($attachment);
		};

		return Response::json($attachment);
	}

	public function removeUpload($bid_id, $attachment_id)
	{		

		$publicFolder = '/uploads/attachments';

		$bid = Bid::findOrFail($bid_id);
		
		if($bid->attachments->contains($attachment_id)){
			$attachment = Attachment::findOrFail($attachment_id);

			$filename = public_path() . $attachment->path;

			if (File::exists($filename)) {
			    File::delete($filename);
			} 

			$attachment->delete();	
		}

		return Response::json(array('success'=>true));
	}

	public function update()
	{
		

		$bid = Bid::findOrFail(Input::get('id'));
		$vendors = array();

		// Get Vendors
		$vendorsList = Session::get('bid.vendors', function() { return array(); });
		if(count($vendorsList)){
			for ($i=0; $i < count($vendorsList); $i++) { 
				$vendors[] = Vendor::find($vendorsList[$i]);
			}
		}
		
		$validator = $bid->validate(Input::all());

		if(!$vendors) {

			$validator->getMessageBag()->add('vendors', 'Please select at least on vendor.');
			return Redirect::route('new_bid')->withInput()->withErrors($validator->errors());
		} else if($validator->passes()){
			
			$bid->active = true;
			$bid->fill(Input::all());
			$bid->save();
			$bid->vendors()->saveMany($vendors);

			Session::forget('bid.vendors');
			
 			return Redirect::route('bids');

		} else {

			return Redirect::route('new_bid')->withInput()->withErrors($validator->errors());
		}

	}

	public function view($bid_id)
	{
		
		$bid = Bid::with('vendors')->findOrFail($bid_id);

		return View::make('pages.bids.view')
			->with('vendor', $this->vendor)
			->with('bid', $bid)
			->with('isVendor', $this->isVendor)
			->with('isOwner', false);	

	}

	public function doResponse($bid_id)
	{
		if($this->vendor->bids->contains($bid_id)){
			
			$bid = Bid::find($bid_id);
			$response = Input::get('response');
			$fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );

			if(preg_match("/^\b\d{1,3}(?:,?\d{3})*(?:\.\d{2})?\b$/", $response)){
				
				$fmt = preg_replace("/[^0-9\.]/", "", $response);

				$bid->vendor($this->vendor->id)->updateExistingPivot($this->vendor->id, ['response'=> $fmt, 'response_timestamp'=>DB::raw('CURRENT_TIMESTAMP')]);				
				return Response::json(array('success' => true, 'message' =>  'Your bid of '.$response.' has been submitted.'));
			} else {
				return Response::json(array('success' => false, 'message' =>  'Enter a valid Currency'));
			}

			
		}
	}

	public function add_vendor_modal($vendor_id)
	{

		$bids = Auth::user()->bids()->with('category')->get();	

		return View::make('modals.bids.add_vendor')
			->with('bids', $bids);
	}

	public function bid_response_modal($bid_id)
	{
		if($this->vendor->bids->contains($bid_id)){
			$bid = Bid::find($bid_id);

			return View::make('modals.bids.response')
				->with('bid', $bid);
		}
	}

	public function get_vendors()
	{
		$vendorsList = Session::get('bid.vendors', function() { return array(); });
		if(count($vendorsList)){
			$vendors = Vendor::getByIds(Session::get('bid.vendors'));	
		} else {
			$vendors = [];
		}
		
		return Response::json($vendors);
	}

	public function add_vendors()
	{

		$vendorsList = Session::get('bid.vendors', function() { return array(); });
		$vendor_id = intval(Input::get('id'));

		if(!in_array($vendor_id, $vendorsList)){
			Session::push('bid.vendors', $vendor_id);
		}

		$vendors = Vendor::getByIds(Session::get('bid.vendors'));
		
		return Response::json($vendors);
	}

	public function remove_vendors()
	{
		$vendorsList = Session::get('bid.vendors', function() { return array(); });
		$vendor_id = intval(Input::get('id'));
		$key = array_search($vendor_id, $vendorsList);

		if($key >= 0){
			unset($vendorsList[$key]);
			Session::set('bid.vendors', array_values($vendorsList));
		}

		$vendors = Vendor::getByIds(Session::get('bid.vendors'));

		return Response::json($vendors);

	}

}
