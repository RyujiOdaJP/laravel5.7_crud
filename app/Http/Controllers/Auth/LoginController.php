<?php

namespace app\Http\Controllers\Auth;

use app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        //after logged in transit to user profile top.
        return redirect('users/' . $user->id)->with('my_status', __('You logged in'));
    }

    /**
     * let user logout.
     * @param \Illiminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(\Illuminate\Http\Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/')->with('my_status', __('You logged out'));
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
