<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Role;
use App\Services\UserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class Registration2Controller extends Controller
{
    public function registrationView()
    {
        $data['countries'] = Country::all();
        $data['roles'] = Role::all();
        return view('auth.register2', compact('data'));
    }


    public function registrationPost(Request $request, UserServices $userServices)
    {
        $userServices->registrationPost($request);
        if (Auth::attempt(['email' => $request->email, "password" => $request->password])) {
            if (Auth::user()->role->name == "Admin") {
                return redirect()->route('admin-dashboard');
            } else {
                return redirect()->route('home');
            }
        }
        return redirect()->back();
    }
}
