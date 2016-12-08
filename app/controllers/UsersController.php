<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('pages.signup');
    }

    public function profile($user_slug)
    {
        $user = User::where('slug',$user_slug)->firstOrFail();
        
        return View::make('pages.users.profile')
            ->with('user', $user);
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {

        $repo = App::make('UserRepository');
        $isVendor = Input::get('is_vendor');
        $user = $repo->signup(Input::all(), $isVendor);

       

        if ($user->id) {

            if($isVendor){
                $role = Role::where('name', 'vendor')->first();
            } else {
                $role = Role::where('name', 'user')->first();
            }

            $user->attachRole($role);
            Auth::login($user, true);

            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->company)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Response::json(array('success' => true));
        } else {
            $error = $user->errors()->all(':message');
             return Response::json(array('success' => false, 'errors' => $error));
        }
    }

    public function signup()
    {
        $categories = Category::all()->lists('name', 'id');

        return View::make('modals.auth.signup')
            ->with('categories', $categories);
    }

    public function update($id)
    {
        
        $user = User::findOrFail($id);
        $input = Input::all();
        $avatar = Input::file('avatar');

        if(isset($input['user'])){
            $user->fill($input['user']);
            
            if($user->save()){
                return Response::json(array('success' => true, 'user' => $user));
            } else {
                return Response::json(array('success' => false));
            }
        } else if ($avatar){

            $validator = Validator::make(array(
                'image' => $avatar), 
            array(
                'image' => 'image'
            ));

            if($validator->passes()){
               
                $uniqueid = uniqid($user->id.'-');
                $publicFolder = '/uploads/avatar/';
                $destinationPath = public_path() . $publicFolder;
                
                $result = Image::make($avatar)
                    ->orientate()
                    ->fit(250, 250)
                    ->save($destinationPath . $uniqueid . '.jpg');

                File::delete(public_path() . $user->avatar);

                $user->avatar = $publicFolder . $uniqueid . '.jpg';
                $user->save();

                return Response::json(array('success' => true, 'image' => $user->avatar));
                
            } else {
                return Response::json(array('success' => false));
            }



                

        }

        
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        if (Confide::user()) {
            return Redirect::to('/');
        } else {
            return View::make('pages.auth.login');
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            if (Request::ajax()){
                return Response::json(array('success' => true));
            } else {
                return Redirect::intended('/');    
            }
            
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            if (Request::ajax()){
                return Response::json(array('success' => false, 'message' => $err_msg));
            } else {
                return Redirect::action('UsersController@login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
            }

            
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {

        if (Confide::forgotPassword(Input::get('email'))) {

            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Response::json(array('success' => true, 'message' =>  $notice_msg));

        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Response::json(array('success' => false, 'message' =>  $error_msg));
        }   
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return View::make('pages.auth.resetpassword')
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $hash = App::make('hash');

        // print_r(Input::all()); die();

        $input = array(
            'token'                 => Input::get('token'),
            'password'              => $hash->make(Input::get('password'))  
        );

       
        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return Redirect::to('/');
    }
}
