<?php

namespace App\Services;

use App\Helpers\ImageHelpers;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    function __construct()
    {
        $this->usersPagination = 20;
    }

    public function allUsers($request)
    {
        $allUsers = User::withoutGlobalScopes()->where('role_id', '!=', 1);

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
            $allUsers = $allUsers->where('role_id', '=', $role_id);
        }
        $data['users'] = $allUsers->simplePaginate($this->usersPagination);
        return $data;
    }

    public function changeUserStatus($userId)
    {
        $user = User::withoutGlobalScopes()->find($userId);

        if ($user->is_active == 0) {
            $user->is_active = 1;
            $user->save();
        } else {
            $user->is_active = 0;
            $user->save();
        }
    }

    public function registrationPost($request)
    {
        $record = User::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if (!$record) {
            User::create(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')), 'role_id' => 3,]));
        } else {
            return redirect()->back();
        }
    }


    public function myProfileUpdate($request, $userId)
    {
        $user = User::withoutGlobalScopes()->find($userId);
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $user->update(array_merge($request->except('_token'), ['profile_image' => "/project-assets/images/users/" . $fileName, 'is_active' => 1, 'password' => Hash::make($request->get('password'))]));
        } else {
            $user->update(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')),]));
        }
    }

    public function addUserPost($request)
    {
        $record = User::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if (!$record) {
            if (!empty($request->profile_image)) {
                $fileName = time() . "-" . 'profile_image' . ".png";
                ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
                User::create(array_merge($request->except('_token'), ['profile_image' => "/project-assets/images/users/" . $fileName, 'is_active' => 1, 'password' => Hash::make($request->get('password'))]));
            } else {
                User::create(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')),]));
            }
        } else {
            return redirect()->back();
        }
    }

    public function editUserUpdate($request, $userId)
    {
        $user = User::withoutGlobalScopes()->find($userId);
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $user->update(array_merge($request->except('_token'), ['profile_image' => "/project-assets/images/users/" . $fileName, 'is_active' => 1, 'password' => Hash::make($request->get('password'))]));
        } else {
            $user->update(array_merge($request->except('_token'), ['is_active' => 1, 'password' => Hash::make($request->get('password')),]));
        }
    }

    public function allTawkToUsers($request)
    {
        $allUsers = User::withoutGlobalScopes()->where('role_id', '=', 3);
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
        $record = User::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if (!$record) {
            User::create(array_merge($request->except('_token'), ['is_active' => 1, 'role_id' => 3,]));
        } else {
            return redirect()->back();
        }
    }

    public function editTawkToUserPost($request, $userId)
    {
        $record = User::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if (!$record) {
            $user = User::withoutGlobalScopes()->find($userId);
            $user->update(array_merge($request->except('_token'), ['is_active' => 1, 'role_id' => 3,]));
        } else {
            return redirect()->back();
        }
    }
}