<?php

class VendorCertificationsController extends Controller
{

    public function index($vendor_slug)
    {
        $vendor = Vendor::getBySlug($vendor_slug);
        return Response::json(array('success' => true, 'certifications' => $vendor->certifications));
    }

    public function store($vendor_slug)
    {
        $vendor = Vendor::getBySlug($vendor_slug);
        $certData = Input::all();
        
        if($certData['name'] && $vendor->user->id == Auth::id()){
            
            $cert = new Certification($certData);

            $vendor->certifications()->save($cert);

            return Response::json(array('success' => true, 'certifications' => $vendor->certifications()->get()));
    
        } else {
            return Response::json( array( 'success' => false ) ); 
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
