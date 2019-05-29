<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Role;
use App\Services\UserServices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function myProfile($userId)
    {
        $data['user'] = User::find($userId);
        $data['countries'] = Country::all();
        $data['roles'] = Role::all();
        return view('admin.user.user-profile', compact('data'));
    }

    public function myProfileUpdate(Request $request, $userId, UserServices $userServices)
    {
        $userServices->myProfileUpdate($request, $userId);
        return redirect()->route('admin-dashboard');
    }
}
