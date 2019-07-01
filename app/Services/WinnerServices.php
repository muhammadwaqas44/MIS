<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/27/2019
 * Time: 7:19 PM
 */

namespace App\Services;


use App\User;
use App\Winner;

class WinnerServices
{
    function __construct()
    {
        $this->usersPagination = 20;
    }

    public function allWinners($request)
    {
        $allUsers = Winner::withoutGlobalScopes()->orderBy('id', 'desc')->where('role_id', '=', 4)->whereNull('deleted_at');

        if ($request->search_title) {
            $search_title = $request->search_title;
            $allUsers = $allUsers->with(['user'])->whereHas('user', function ($query) use ($search_title) {
                $full_name = $search_title;
                $splitName = explode(' ', $full_name, 2);
                $firstName = $splitName[0];
                $lastName = !empty($splitName[1]) ? $splitName[1] : '';
                $query->where('first_name', 'like', '%' . $firstName . '%')->orWhere('last_name', 'like', '%' . $lastName . '%')
                    ->orWhere('email', 'like', '%' . $search_title . '%')
                    ->orWhere('user_phone', 'like', '%' . $search_title . '%')
                    ->orWhere('address', 'like', '%' . $search_title . '%');
            });
        }
        if ($request->filled('search_email')) {
            $email = $request->search_email;
            $allUsers = $allUsers->where('status', '=', $email );
        }
        if ($request->filled('search_phone')) {
            $phone = $request->search_phone;
            $allUsers = $allUsers->where('user_phone', 'like', '%' . $phone . '%');
        }

        $data['winners'] = $allUsers->paginate($this->usersPagination);
        return $data;
    }

    public function addWinnerPost($request)
    {
        $record = User::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if (!$record) {
            $user = User::create([
                'is_active' => 1,
                'role_id' => 4,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'user_phone' => $request->user_phone,
                'address' => $request->address,
            ]);
            Winner::create([
                'is_active' => 1,
                'role_id' => 4,
                'user_id' => $user->id,
                'cnic' => $request->cnic,
                'account' => $request->account,
                'prize' => $request->prize,
                'social_link' => $request->social_link,
                'status' => $request->status,
                'question' => $request->question,
            ]);
        } else {
            Winner::create([
                'is_active' => 1,
                'role_id' => 4,
                'user_id' => $record->id,
                'cnic' => $request->cnic,
                'account' => $request->account,
                'prize' => $request->prize,
                'social_link' => $request->social_link,
                'status' => $request->status,
                'question' => $request->question,
            ]);
        }
    }

    public function editWinnerPost($request, $winnerId)
    {
        $user = User::withoutGlobalScopes()->find($request->user_id);
        $winner = Winner::find($winnerId);
        $user->is_active = 1;
        $user->role_id = 4;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->user_phone = $request->user_phone;
        $user->address = $request->address;
        $user->save();
        $winner->is_active = 1;
        $winner->role_id = 4;
        $winner->user_id = $request->user_id;
        $winner->cnic = $request->cnic;
        $winner->account = $request->account;
        $winner->prize = $request->prize;
        $winner->social_link = $request->social_link;
        $winner->status = $request->status;
        $winner->question = $request->question;
        $winner->save();
    }

}