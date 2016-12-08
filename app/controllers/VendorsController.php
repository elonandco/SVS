<?php

class VendorsController extends Controller
{

    public function profile($vendor_slug)
    {
        $vendor = Vendor::with(array('user','services'))->where('slug',$vendor_slug)->firstOrFail();
        
        $isOwner = $vendor->user->id == Auth::id();
        $isVendor = $vendor->user->hasRole('vendor');


        Assets::add('directives/project-gallery/project-gallery.js');

        if($isOwner){
            Assets::add('controllers/profile-controller.js');
            Assets::add('directives/us-states/us-states.js');
            Assets::add('directives/file-uploader/file-uploader.js');
            Assets::add('directives/image-uploader/image-uploader.js');
            Assets::add('directives/vendor-services/vendor-services.js');
            Assets::add('directives/vendor-certifications/vendor-certifications.js');
            Assets::add('directives/popover/popover.js');
        } else if (Auth::id()){
            Visit::register($vendor->id, Auth::user());
        }
        

      
        return View::make('pages.vendors.profile')
            ->with('vendor', $vendor)
            ->with('isOwner', $isOwner)
            ->with('isVendor', $isVendor)
            ->with('projects', $vendor->projects()->take(6)->get())
            ->with('breakdown', $vendor->breakdown())
            ->with('reviews', $vendor->reviews()->ordered()->take(4)->get());
    }

    public function get_vendor ($slug) {
        $vendor = Vendor::where('slug',$slug)->firstOrFail();

        return Response::json(array('success' => true, 'vendor' => $vendor));
    }

    public function update($slug)
    {
        
        $vendor = Vendor::where('slug',$slug)->firstOrFail();
        $input = Input::all();
        $hero = Input::file('hero');

        if(isset($input['vendor'])){
            $vendor->fill($input['vendor']);
            
            if($vendor->save()){
                return Response::json(array('success' => true, 'vendor' => $vendor));
            } else {
                return Response::json(array('success' => false));
            }
        } else if($hero){
            
            $validator = Validator::make(array(
                'image' => $hero), 
            array(
                'image' => 'image'
            ));

            if($validator->passes()){
               
                $uniqueid = uniqid($vendor->id.'-');
                $publicFolder = '/uploads/hero/';
                $destinationPath = public_path() . $publicFolder;
                
                $result = Image::make($hero)
                    ->orientate()
                    ->resize(1600, 1600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($destinationPath . $uniqueid . '.jpg');

                File::delete(public_path() . $vendor->hero);

                $vendor->hero = $publicFolder . $uniqueid . '.jpg';
                $vendor->save();

                return Response::json(array('success' => true, 'image' => $vendor->hero));
                
            } else {
                return Response::json(array('success' => false));
            }

        }
        

        
    }

    public function viewers($vendor_slug)
    {
        
        $vendor = Vendor::with(array('user'))->where('slug',$vendor_slug)->firstOrFail();

        return View::make('pages.vendors.profile.viewers')
             ->with('vendor', $vendor)
             ->with('visits', $vendor->recentVisits->get())
             ->with('breakdown', $vendor->breakdown());

    }

    public function viewers_summary($vendor_slug)
    {

        $vendor = Vendor::with(array('user'))->where('slug',$vendor_slug)->firstOrFail();

        return View::make('modals.vendors.visits')
            ->with('visits', $vendor->recentVisits->get()); 
    }

    public function get_projects($vendor_slug)
    {
        $vendor = Vendor::getBySlug($vendor_slug);
        return Response::json($vendor->projects);
    }
    

    public function add_project($vendor_slug)
    {

        $max_width = 500;

        $thumb_width = 125;
        $thumb_height = 125;

        $vendor = Vendor::getBySlug($vendor_slug);
        $file = Input::file('image');

        $validator = Validator::make(array(
            'image' => $file), 
        array(
            'image' => 'image'
        ));

        if($vendor->user->id == Auth::id() && $validator->passes()){

            $publicFolder = '/uploads/projects/';
            $destinationPath = public_path() . $publicFolder;

            $uniqueid = uniqid($vendor->id);
            $extension = 'jpg';

            $filename = $uniqueid . '.' . $extension;
            $thumbname = $uniqueid . '_' . $thumb_width .'x' . $thumb_height . '.' . $extension;

            //Make the Full size image
            Image::make($file)
                ->orientate()
                ->resize($max_width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath . $filename);

            //Make the thumbnail
            Image::make($file)->fit($thumb_width, $thumb_height)
                ->save($destinationPath . $thumbname);

            //Save the image
            $project = new Project(array('image'=>$publicFolder . $filename, 'image_small' => $publicFolder . $thumbname));
            $vendor->projects()->save($project);

            return Response::json($vendor->projects);
               
        }
        
    }

}
