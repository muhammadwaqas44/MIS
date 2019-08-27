<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\ContentType;
use App\CPlatform;
use App\CStatus;
use App\Services\ContentServices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function allPlans(Request $request, ContentServices $contentServices)
    {
        $data['plans'] = $contentServices->allPlans($request);
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::all();
        return view('admin.content.plan.all-plans', compact('data'));
    }

    public function createPlan()
    {
        $data['users'] = User::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::all();
        return view('admin.content.plan.create-plan', compact('data'));
    }

    public function editPlan($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = User::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::all();
        return view('admin.content.plan.edit-plan', compact('data', 'plan'));
    }

    public function producePlan($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = User::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['statuses'] = CStatus::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::all();
        return view('admin.content.plan.produce-plan', compact('data', 'plan'));
    }

    public function postContentPlan(Request $request, ContentServices $contentServices)
    {
//        dd($request->all());
        $contentServices->postContentPlan($request);
        return redirect()->route('admin.all-plans');
    }
}
