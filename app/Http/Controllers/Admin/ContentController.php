<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class ContentController extends Controller
{
    public function createPlan()
    {
        $data['users'] = User::all();
        $data['category'] = Category::where('id','!=',1)->get();
        return view('admin.content.plan.create-plan', compact('data'));
    }
}
