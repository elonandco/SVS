<?php



/**
 * Class UserRepository
 *
 * This service abstracts some interactions that occurs between Confide and
 * the Database.
 */
class UserRepository
{
    /**
     * Signup a new account with the given parameters
     *
     * @param  array $input Array containing 'username', 'email' and 'password'.
     *
     * @return  User User object that may or may not be saved successfully. Check the id to make sure.
     */
    public function signup($input, $isVendor)
    {

        $hash = App::make('hash');

        $category = Category::find(array_get($input, 'category_id'));

        $user = new User;
        $user->email    = array_get($input, 'email');
        $user->password = $hash->make(array_get($input, 'password'));
        $user->first_name = array_get($input, 'first_name');
        $user->last_name = array_get($input, 'last_name');
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $userValidation = $user->isValid();

        $vendor = new Vendor;
        $vendor->name = array_get($input, 'company');
        $vendor->phone = array_get($input, 'phone');
        $vendor->zip = array_get($input, 'zip');
        $vendor->address = array_get($input, 'address');
        $vendor->slug = $this->generate_slug($vendor->name);

        if($isVendor){
            $vendorValidation = Validator::make(
                $input,
                array(
                    'company' => 'required|min:3',
                    'phone' => 'required',
                    'zip' => 'required|min:5',
                    'address' => 'required'
                )
            );
        } else {
             $vendorValidation = $vendor->validate();     
        }
        
    
        /* Validate the category if it's a new vendor */
        if($isVendor && ! $category){
            $vendorValidation = false;
            $vendor->errors()->add('error','The category is required.');
        }

        if($userValidation && $vendorValidation){

            $user->save();

            if($user->id){
                $vendor->user_id = $user->id;
                $vendor->save();

                /* Attach the category */
                if($category && $category->id){
                    $vendor->categories()->attach($category, array('primary' => 1));
                }
            }

        } else {
            $user->errors()->merge($vendor->errors());
        }

        return $user;
    }

    private function generate_slug($title)
    {
        $slug = Str::slug($title);
        $slugCount = count( Vendor::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }


    /**
     * Attempts to login with the given credentials.
     *
     * @param  array $input Array containing the credentials (email/username and password)
     *
     * @return  boolean Success?
     */
    public function login($input)
    {
        if (! isset($input['password'])) {
            $input['password'] = null;
        }

        return Confide::logAttempt($input, Config::get('confide::signup_confirm'));
    }

    /**
     * Checks if the credentials has been throttled by too
     * much failed login attempts
     *
     * @param  array $credentials Array containing the credentials (email/username and password)
     *
     * @return  boolean Is throttled
     */
    public function isThrottled($input)
    {
        return Confide::isThrottled($input);
    }

    /**
     * Checks if the given credentials correponds to a user that exists but
     * is not confirmed
     *
     * @param  array $credentials Array containing the credentials (email/username and password)
     *
     * @return  boolean Exists and is not confirmed?
     */
    public function existsButNotConfirmed($input)
    {
        $user = Confide::getUserByEmailOrUsername($input);

        if ($user) {
            $correctPassword = Hash::check(
                isset($input['password']) ? $input['password'] : false,
                $user->password
            );

            return (! $user->confirmed && $correctPassword);
        }
    }

    /**
     * Resets a password of a user. The $input['token'] will tell which user.
     *
     * @param  array $input Array containing 'token', 'password' and 'password_confirmation' keys.
     *
     * @return  boolean Success
     */
    public function resetPassword($input)
    {
        $result = false;
        $user   = Confide::userByResetPasswordToken($input['token']);

        if ($user) {
            $user->password              = $input['password'];
            $result = $this->save($user);
        }

        // If result is positive, destroy token
        if ($result) {
            Confide::destroyForgotPasswordToken($input['token']);
        }

        return $result;
    }

    /**
     * Simply saves the given instance
     *
     * @param  User $instance
     *
     * @return  boolean Success
     */
    public function save(User $instance)
    {
        return $instance->save();
    }
}
