<?php
/**
 * Created by PhpStorm.
 * Date: 6/27/2019
 * Time: 7:19 PM
 */

namespace App\Services;


use App\User;
use App\Winner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $allUsers = $allUsers->where('status', '=', $email);
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
        if (!empty($request->winning_date)) {
            $winning_date= Carbon::parse(str_replace('-', '', $request->winning_date))->format('Y-m-d');
        } else {
            $winning_date = null;
        }
        if ($request->email) {
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
                    'password' => Hash::make('12345'),
                ]);
                Winner::create([
                    'is_active' => 1,
                    'role_id' => 4,
                    'user_id' => $user->id,
                    'cnic' => $request->cnic,
                    'account' => $request->account,
                    'prize' => $request->prize,
                    'social_link' => $request->social_link,
                    'status' => 73,
                    'question' => $request->question,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'user_phone' => $request->user_phone,
                    'address' => $request->address,
                    'winning_date' =>$winning_date,
                    'created_by' => auth()->user()->id,
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
                    'status' => 73,
                    'question' => $request->question,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'user_phone' => $request->user_phone,
                    'address' => $request->address,
                    'winning_date' => $winning_date,
                    'created_by' => auth()->user()->id,
                ]);
            }
        } else {
            Winner::create([
                'is_active' => 1,
                'role_id' => 4,
                'created_by' => auth()->user()->id,
                'cnic' => $request->cnic,
                'account' => $request->account,
                'prize' => $request->prize,
                'social_link' => $request->social_link,
                'status' => 73,
                'question' => $request->question,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_phone' => $request->user_phone,
                'winning_date' => $winning_date,
                'address' => $request->address,
            ]);
        }
    }

    public function editWinnerPost($request, $winnerId)
    {
//        dd($request->all());
        if (!empty($request->winning_date)) {
            $winning_date= Carbon::parse(str_replace('-', '', $request->winning_date))->format('Y-m-d');
        } else {
            $winning_date = null;
        }
        $winner = Winner::find($winnerId);
        if ($request->email) {
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
                    'password' => Hash::make('12345'),
                ]);
                $winner->is_active = 1;
                $winner->role_id = 4;
                $winner->first_name = $request->first_name;
                $winner->last_name = $request->last_name;
                $winner->user_phone = $request->user_phone;
                $winner->address = $request->address;
                $winner->user_id = $user->id;
                $winner->cnic = $request->cnic;
                $winner->account = $request->account;
                $winner->prize = $request->prize;
                $winner->social_link = $request->social_link;
                $winner->status = $request->status;
                $winner->question = $request->question;
                $winner->winning_date = $winning_date;
                $winner->created_by = auth()->user()->id;
                $winner->save();
            } else {
                $record->is_active = 1;
                $record->role_id = 4;
                $record->first_name = $request->first_name;
                $record->last_name = $request->last_name;
                $record->email = $request->email;
                $record->user_phone = $request->user_phone;
                $record->address = $request->address;
                $record->save();
                $winner->is_active = 1;
                $winner->role_id = 4;
                $winner->first_name = $request->first_name;
                $winner->last_name = $request->last_name;
                $winner->user_phone = $request->user_phone;
                $winner->address = $request->address;
                $winner->cnic = $request->cnic;
                $winner->account = $request->account;
                $winner->prize = $request->prize;
                $winner->social_link = $request->social_link;
                $winner->status = $request->status;
                $winner->question = $request->question;
                $winner->winning_date = $winning_date;
                $winner->created_by = auth()->user()->id;
                $winner->save();
            }
        } else {
            $winner->is_active = 1;
            $winner->role_id = 4;
            $winner->first_name = $request->first_name;
            $winner->last_name = $request->last_name;
            $winner->user_phone = $request->user_phone;
            $winner->address = $request->address;
            $winner->cnic = $request->cnic;
            $winner->account = $request->account;
            $winner->prize = $request->prize;
            $winner->social_link = $request->social_link;
            $winner->status = $request->status;
            $winner->question = $request->question;
            $winner->winning_date = $winning_date;
            $winner->created_by = auth()->user()->id;
            $winner->save();
        }
    }

}