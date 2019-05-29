<?php

namespace App\Services;

use App\Helpers\ImageHelpers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function registrationPost($request)
    {
          User::create(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')), 'role_id' => 3,]));
    }

    public function myProfileUpdate($request, $userId)
    {
        $user = User::find($userId);
        $fileName = time() . "-" . 'profile_image' . ".png";
        ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
        $user->update(array_merge($request->except('_token'), ['profile_image' => "/project-assets/images/users/" . $fileName, 'is_active' => 1, 'password' => Hash::make($request->get('password'))]));
    }

}