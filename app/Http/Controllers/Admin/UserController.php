<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Exports\TawkToUsersExport;
use App\Imports\TawkToUsersImport;
use App\Role;
use App\Services\UserServices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function allUsers(Request $request, UserServices $userServices)
    {
        $data['roles'] = Role::all();
        $data['users'] = $userServices->allUsers($request);
        return view('admin.user.all-users', compact('data'));
    }

    public function changeUserStatus($userId, UserServices $userServices)
    {
        $userServices->changeUserStatus($userId);
        return redirect()->back();
    }

    public function deleteUser($userId)
    {
        User::withoutGlobalScopes()->find($userId)->delete();
        return redirect()->back();
    }

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

    public function addUser()
    {
        $data['countries'] = Country::all();
        $data['roles'] = Role::all();
        return view('admin.user.add-user', compact('data'));
    }

    public function addUserPost(Request $request, UserServices $userServices)
    {
        $userServices->addUserPost($request);
        return redirect()->route('admin.all-users');
    }

    public function editUser($userId)
    {
        $data['user'] = User::withoutGlobalScopes()->find($userId);
        $data['countries'] = Country::all();
        $data['roles'] = Role::all();
        return view('admin.user.edit-user', compact('data'));
    }

    public function editUserUpdate(Request $request, $userId, UserServices $userServices)
    {
        $userServices->editUserUpdate($request, $userId);
        return redirect()->route('admin.all-users');
    }

    public function allTawkToUsers(Request $request, UserServices $userServices)
    {
        $data['tawk_to_users'] = $userServices->allTawkToUsers($request);
        return view('admin.user.all-tawk-to-users', compact('data'));
    }

    public function addTawkToUserPost(Request $request, UserServices $userServices)
    {

        $userServices->addTawkToUserPost($request);
        return redirect()->back();
    }

    public function editTawkToUserPost(Request $request, $userId, UserServices $userServices)
    {
        $userServices->editTawkToUserPost($request, $userId);
        return redirect()->back();
    }

    public function exportTawkToUser()
    {
        return Excel::download(new TawkToUsersExport, 'tawk-to-user.xlsx');
    }

    public function importTawkToUser()
    {
        Excel::import(new TawkToUsersImport, request()->file('import_file'));

        return back();
    }
}
