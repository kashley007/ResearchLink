<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\profileHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Lang;
use App\Notifications\VerifyEmail;
use App\Notifications\Welcome;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'user_type' => 'required'
        ], [
            'user_type.required' => 'User type is required'
        ]);
    }

    protected function validatorLogin(array $data)
    {
        return Validator::make($data, [
            
            'email' => 'required|email',
            'password' => 'required',
        
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(50);
       
        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code,
            'confirmed' => 0
        ]);
        
        $userData = array('first_name' => $data['first_name'], 'email' => $data['email'], 'confirmation_code' => $confirmation_code );
        
        //Create register email
        // Mail::send('auth.emails.verify', ['userData' => $userData], function ($message) use ($userData) {
        //     $message->to($userData['email'], $userData['first_name'])
        //        ->subject('Verify your email address');
        // });

        VerifyEmail::toMail($userData);
        unset( $userData );
    }
    /**
     * Register a new user instance after a valid registration.
     *
     * @param  $request
     * @return redirect to login screen
     */
    public function register(Request $request)
    {
        
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $this->create($request->all());
        $user = User::whereEmail($request->email)->first();
        $user->profile->user_type = $request->user_type;
        $user->profile->save();
        Session::flash('message', 'Thank you for signing up! Please check your email to verify your account'); 
        return Redirect::to('login');
    }
    /**
     * Confrim a new user instance after user clicks on confirmation email link.
     *
     * @param  $request
     * @return redirect to login screen
     */
    public function confirm($confirmation_code)
    {
       
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        //Create the welcome notification
        
        Welcome::toDatabase($user);
         
        $user->save();
        Session::flash('message', 'Thank you for verifying your account.'); 

        return Redirect::to('login');
    }

    protected function getCredentials(Request $request){
        
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }

     /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

    }
    
    protected function authenticated(Request $request, User $user){

        if($user->confirmed === 0){
            Auth::logout();
            Session::flash('message', 'Please verify your account before logging in'); 
            return Redirect::to('login')
                            ->withInput();
        }else{
            return redirect()->intended($this->redirectPath());
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        
        $validator = $this->validatorLogin($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
            
       
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();
        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            
            return $this->handleUserWasAuthenticated($request, $throttles);
        }else{
            return $this->sendFailedLoginResponse($request);
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

    }
}