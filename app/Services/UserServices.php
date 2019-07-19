<?php

namespace App\Services;

use App\Helpers\ImageHelpers;
use App\Massege;
use App\SmsLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class UserServices
{
    function __construct()
    {
        $this->usersPagination = 20;
    }

    public function allUsers($request)
    {
        $allUsers = User::withoutGlobalScopes()->orderBy('id', 'desc')->where('role_id', '!=', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $full_name = $request->search_title;
            $splitName = explode(' ', $full_name, 2);
            $firstName = $splitName[0];
            $lastName = !empty($splitName[1]) ? $splitName[1] : '';
            $allUsers = $allUsers->where('first_name', 'like', '%' . $firstName . '%')->orWhere('last_name', 'like', '%' . $lastName . '%');
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
        $data['users'] = $allUsers->paginate($this->usersPagination);
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
        $allUsers = User::withoutGlobalScopes()->orderBy('id', 'desc')->where('role_id', '=', 3)->whereNull('deleted_at');
        if ($request->search_title) {
            $full_name = $request->search_title;
            $splitName = explode(' ', $full_name, 2);
            $firstName = $splitName[0];
            $lastName = !empty($splitName[1]) ? $splitName[1] : '';
            $allUsers = $allUsers->where('first_name', 'like', '%' . $firstName . '%')->orWhere('last_name', 'like', '%' . $lastName . '%');
        }
        if ($request->filled('search_email')) {
            $email = $request->search_email;
            $allUsers = $allUsers->where('email', 'like', '%' . $email . '%');
        }
        if ($request->filled('search_phone')) {
            $phone = $request->search_phone;
            $allUsers = $allUsers->where('user_phone', 'like', '%' . $phone . '%');
        }
        $data['tawk_to_users'] = $allUsers->paginate($this->usersPagination);
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

    public function editTawkToUserPost($request)
    {
        $userId = $request->id;
        $user = User::withoutGlobalScopes()->find($userId);
        $user->update(array_merge($request->except('_token'), ['is_active' => 1, 'role_id' => 3,]));

    }

    public function smsTawkToUsers($request)
    {
        $userId = $request->userId;
        $user = User::withoutGlobalScopes()->find($userId);
        $userPhone = $user->user_phone;
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $name = ucfirst($first_name) . ' ' . ucfirst($last_name);
        $massege = $request->massegeBody;
        $massegeBody = str_replace('$name', $name, $massege);
        $jazzMassegeApi = 'https://connect.jazzcmt.com/sendsms_url.html?Username=03081279299&Password=Pakistan1&From=DANKASH&To=' . $userPhone . '&Message=' . $massegeBody . '';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $jazzMassegeApi);
        $result = $response->getBody()->getContents();
        SmsLog::create([
            'is_active' => 1,
            'recipient_no' => $userPhone,
            'body' => $massegeBody,
            'sent_on' => Carbon::now(),
            'sent_by' => Auth::user()->id,
            'status' => $result,
            'masking' => 'DANKASH',
            'reference' => 'DANKASH Promotion',
        ]);
    }

    public function smsTawkToAllUsers($massegeId)
    {
        $allUsers = User::withoutGlobalScopes()->where('role_id', '=', 3)->whereNull('deleted_at')->get();
        set_time_limit(6000);
        $normalTimeLimit = ini_get('max_execution_time');
        ini_set('max_execution_time', 6000);
        ini_set('max_execution_time', $normalTimeLimit);
        foreach ($allUsers as $user) {
            $userPhone = $user->user_phone;
            $massege = Massege::find($massegeId);
            $first_name = $user->first_name;
            $last_name = $user->last_name;
            $name = ucfirst($first_name) . ' ' . ucfirst($last_name);
            $massegeBody = str_replace('$name', $name, $massege->body);
            $jazzMassegeApi = 'https://connect.jazzcmt.com/sendsms_url.html?Username=03081279299&Password=Pakistan1&From=DANKASH&To=' . $userPhone . '&Message=' . $massegeBody . '';
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $jazzMassegeApi);
            $result = $response->getBody()->getContents();
            $smsId = SmsLog::create([
                'is_active' => 1,
                'recipient_no' => $userPhone,
                'body' => $massegeBody,
                'sent_on' => Carbon::now(),
                'sent_by' => Auth::user()->id,
                'status' => $result,
                'masking' => 'DANKASH',
                'reference' => 'DANKASH Promotion',
            ]);
        }
    }
}