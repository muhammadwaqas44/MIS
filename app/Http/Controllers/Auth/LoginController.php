<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function loginPost(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, "password" => $request->password])) {
            if (Auth::user()->role->name == "Admin") {
                return redirect()->route('admin-dashboard');
            } else{
                return redirect()->route('home');
            }
        }
        return redirect()->back();

    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login');

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
