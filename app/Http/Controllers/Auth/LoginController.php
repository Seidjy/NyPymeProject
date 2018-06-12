<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\LogLogin;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
        login as loginUser;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $attemptsLimit = 5;
    protected $maxAttempts = 5;
    protected $decayMinutes = 5;

/*
***LOGIN***
***********
ACtion  = Sucesso

*/
    public function login(Request $request)
    {

        $logLogin = [
            'ip' => $request->ip(),
            'user' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $this->validateLogin($request);

        if (!$this->validateLoginAttempt($request)) {
            $this->fireLockoutEvent($request);

            $users = User::find($id)->update(['role' => 3]);

            return $this->sendLockoutResponse($request);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $users = User::find($id)->update(['role' => 3]);

            return $this->sendLockoutResponse($request);
        }
  
        if ($this->attemptLogin($request)) {
            $logLogin['action'] = 'Sucesso';
            LogLogin::create($logLogin);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        $logLogin['action'] = 'Insucesso';

        LogLogin::create($logLogin);

        return $this->sendFailedLoginResponse($request);
    }

    public function validateLoginAttempt(Request $request){
        $attemptsLimit = 5;
        $attempts = LogLogin::where('ip', $request->ip())->orderBy('created_at', 'desc')->take($attemptsLimit)->get();
        
        $attemptsCounter = 1;

        $users = DB::table('users')->where('email',$request->input('email'))->get();

        foreach ($users as $user) {
            if ($user->role == "3"){
                return false;
            }
        }

        foreach ($attempts as $attempt) {
            if ($attempt['action'] == "Insucesso") {
                $attemptsCounter++;
            }
        }

        if ($attemptsCounter >= ($attemptsLimit-1)) {
            return false;
        }

        $attempts = LogLogin::where('user', $request->input('user'))->orderBy('created_at', 'desc')->take($attemptsLimit)->get();
        
        $attemptsCounter = 1;

        foreach ($attempts as $attempt) {
            if ($attempt['action'] == "Insucesso") {
                $attemptsCounter++;
            }
        }

        if ($attemptsCounter >= ($attemptsLimit-1)) {
            return false;
        }

        return true;
    }
    
    public function saveLoginAttemptData(Request $request){

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
