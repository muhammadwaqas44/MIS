<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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
            } elseif (Auth::user()->role->name == "User") {
                return redirect()->route('welcome');
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
        return redirect()->route('welcome');

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
