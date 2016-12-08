<?php

class VendorServicesController extends Controller
{

    public function index($vendor_slug)
    {
        $vendor = Vendor::getBySlug($vendor_slug);
        return Response::json($vendor->services);
    }

    public function store($vendor_slug)
    {
        $vendor = Vendor::getBySlug($vendor_slug);
        $name = Input::get('name');
        
        if($name && $vendor->user->id == Auth::id()){
            
            $service = Service::where('name',$name)->first();
            
            if(!$service){
                $service = new Service(array('name'=>$name));
                $service->save();
            }

            if (!$vendor->services->contains($service->id)) {
                $vendor->services()->attach($service);
            }

            return Response::json(array('success' => true, 'services' => $vendor->services()->get()));
    
        }
    }

    public function destroy($vendor_slug, $service_id)
    {
        $vendor = Vendor::getBySlug($vendor_slug);

        if($vendor->user->id == Auth::id() && $vendor->services->contains($service_id)){
            $vendor->services()->detach($service_id);

            return Response::json(array('success' => true, 'services' => $vendor->services()->get()));
        } else {
           return Response::json( array( 'success' => false ) ); 
        }
    }

}
