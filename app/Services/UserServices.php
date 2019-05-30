<?php

namespace App\Services;

use App\Helpers\ImageHelpers;
use App\TawkUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    function __construct()
    {
        $this->usersPagination = 10;
    }

    public function allUsers($request)
    {
        $allUsers = User::withoutGlobalScopes()->orderBy('id', 'desc');

        if ($request->search_title) {
            $first_name = $request->search_title;
            $allUsers = $allUsers->where('first_name', 'like', '%' . $first_name . '%');
        }
        if ($request->filled('search_email')) {
            $email = $request->search_email;
            $allUsers = $allUsers->where('email', 'like', '%' . $email . '%');
        }
        if ($request->filled('search_phone')) {
            $phone = $request->search_phone;
            $allUsers = $allUsers->where('user_phone', 'like', '%' . $phone . '%');
        }
        if ($request->filled('role_id')) {
            $role_id = $request->role_id;
            $allUsers = $allUsers->where('role_id', 'like', '%' . $role_id . '%');
        }
        $data['users'] = $allUsers->simplePaginate($this->usersPagination);
        return $data;
    }

    public function changeUserStatus($userId)
    {
        $user = User::withoutGlobalScopes()->find($userId);

        if ($user->is_active == 0) {
//            $user->update(['is_active' => 1]);
            $user->is_active = 1;
            $user->save();
            return redirect()->back();
        } else {
//            $user->update(['is_active' => 0]);
            $user->is_active = 0;
            $user->save();
            return redirect()->back();
        }
    }

    public function registrationPost($request)
    {
        User::create(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')), 'role_id' => 3,]));
    }

    public function myProfileUpdate($request, $userId)
    {
        $user = User::withoutGlobalScopes()->find($userId);
        $fileName = time() . "-" . 'profile_image' . ".png";
        ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
        $user->update(array_merge($request->except('_token'), ['profile_image' => "/project-assets/images/users/" . $fileName, 'is_active' => 1, 'password' => Hash::make($request->get('password'))]));
    }

    public function addUserPost($request)
    {
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            User::create(array_merge($request->except('_token'), ['profile_image' => "/project-assets/images/users/" . $fileName, 'is_active' => 1, 'password' => Hash::make($request->get('password'))]));

        } else {
            User::create(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')),]));
        }
    }

    public function allTawkToUsers($request)
    {
        $allUsers = User::withoutGlobalScopes()->where('role_id', '=', 4);

        if ($request->search_title) {
            $first_name = $request->search_title;
            $allUsers = $allUsers->where('first_name', 'like', '%' . $first_name . '%');
        }
        if ($request->filled('search_email')) {
            $email = $request->search_email;
            $allUsers = $allUsers->where('email', 'like', '%' . $email . '%');
        }
        if ($request->filled('search_phone')) {
            $phone = $request->search_phone;
            $allUsers = $allUsers->where('user_phone', 'like', '%' . $phone . '%');
        }

        $data['tawk_to_users'] = $allUsers->simplePaginate($this->usersPagination);
        return $data;
    }

    public function addTawkToUserPost($request)
    {
        User::create(array_merge($request->except('_token'), ['is_active' => 1, 'role_id' => 4,]));
    }

    public function editTawkToUserPost($request, $userId)
    {
        $user = User::withoutGlobalScopes()->find($userId);
        $user->update(array_merge($request->except('_token'), ['is_active' => 1, 'role_id' => 4,]));
    }
}