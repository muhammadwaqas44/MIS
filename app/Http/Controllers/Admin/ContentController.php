<?php

namespace App\Http\Controllers\Admin;

use App\CMedia;
use App\Content;
use App\ContentType;
use App\CPlatform;
use App\CPlatformUsed;
use App\CStatus;
use App\CYoutube;
use App\Employee;
use App\Services\ContentServices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function addIdea()
    {
        return view('admin.content.idea.add');
    }

    public function allIdeas(Request $request, ContentServices $contentServices)
    {
        $data['allIdeas'] = $contentServices->allIdeas($request);
        return view('admin.content.idea.list', compact('data'));
    }

    public function postIdea(Request $request, ContentServices $contentServices)
    {
        $contentServices->postIdea($request);
        return redirect()->route('admin.all-ideas');
    }


    public function editIdea($ideaId)
    {
        $stId = [2, 3];
        $idea = Content::find($ideaId);
        $data['statuses'] = CStatus::withoutGlobalScopes()->whereIn('id', $stId)->get();

        return view('admin.content.idea.view', compact('idea', 'data'));
    }

    public function updateIdea(Request $request, $ideaId, ContentServices $contentServices)
    {
        $contentServices->updateIdea($request, $ideaId);
        return redirect()->back();
    }

    public function allPlans(Request $request, ContentServices $contentServices)
    {
        $data['plans'] = $contentServices->allPlans($request);
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::all();
        return view('admin.content.plan.all-plans', compact('data'));
    }

    public function createPlan()
    {
        $data['users'] = Employee::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::where('id', '!=', 1)->get();
        return view('admin.content.plan.create-plan', compact('data'));
    }


    public function editPlan($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::where('id', '!=', 1)->get();
        return view('admin.content.plan.edit-plan', compact('data', 'plan'));
    }

    public function producePlan($planId)
    {
        $stId = [5, 6];
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['statuses'] = CStatus::withoutGlobalScopes()->whereIn('id', $stId)->get();
        $data['platforms'] = CPlatform::where('id', '!=', 1)->get();
        return view('admin.content.plan.produce-plan', compact('data', 'plan'));
    }

    public function addContentCat(Request $request)
    {
        ContentType::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }

    public function postContentPlan(Request $request, ContentServices $contentServices)
    {
        $contentServices->postContentPlan($request);
        return redirect()->route('admin.all-plans');
    }

    public function editPlanPost(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->editPlanPost($request, $planId);
        return redirect()->back();
    }

    public function producePlanPost(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->producePlanPost($request, $planId);
        return redirect()->back();
    }

    public function producePlanHistory(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->producePlanHistory($request, $planId);
        return redirect()->back();
    }

//    public function planHistory(Request $request, $hisId, ContentServices $contentServices)
//    {
//        $contentServices->planHistory($request, $hisId);
//        return redirect()->route('admin.all-plans');
//    }

    public function allContentGenerationView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['statuses'] = CStatus::where('id', '=', 9)->get();
        return view('admin.content.process.view', compact('data', 'plan'));
    }

    public function allContentGeneration(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allContentGeneration'] = $contentServices->allContentGeneration($request);
        return view('admin.content.process.list', compact('data'));
    }

    public function seoView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['statuses'] = CStatus::where('id', '=', 9)->get();
        return view('admin.content.seo.view', compact('data', 'plan'));
    }

    public function allReviewView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['statuses'] = CStatus::where('id', '=', 10)->get();
        return view('admin.content.review.view', compact('data', 'plan'));
    }

    public function allSEOList(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allContentGeneration'] = $contentServices->allContentGeneration($request);
        return view('admin.content.seo.list', compact('data'));
    }

    public function allReview(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allReview'] = $contentServices->allReview($request);
        return view('admin.content.review.list', compact('data'));
    }

    public function seoPlanPlatform($platFormId, $planId, $platUsedId)
    {
        $content = Content::find($planId);
        if ($platFormId == 2) {
            $data['youtube_licenses'] = CStatus::where('module', '=', 'youtube_license')->get();
            $data['youtube_views'] = CStatus::where('module', '=', 'youtube_view')->get();
            $data['statuses'] = CStatus::where('id', 8)->get();
            return view('admin.content.platformSEO.youtube', compact('content', 'data', 'platFormId', 'platUsedId'));
        } elseif ($platFormId == 3) {
            $data['facebook_views'] = CStatus::where('module', '=', 'facebook_view')->get();
            return view('admin.content.platformSEO.facebook', compact('content', 'data', 'platUsedId'));
        } elseif ($platFormId == 4) {
            return view('admin.content.platformSEO.instagram', compact('content', 'platUsedId'));
        } elseif ($platFormId == 5) {
            return view('admin.content.platformSEO.Instagram-IGTV', compact('content', 'platUsedId'));
        } elseif ($platFormId == 6) {
            return view('admin.content.platformSEO.instagram-stories', compact('content', 'platUsedId'));
        } elseif ($platFormId == 7) {
            return view('admin.content.platformSEO.instagram-feeds', compact('content', 'platUsedId'));
        } elseif ($platFormId == 8) {
            return view('admin.content.platformSEO.twitter', compact('content', 'platUsedId'));
        } elseif ($platFormId == 9) {
            return view('admin.content.platformSEO.linkedIn', compact('content', 'platUsedId'));
        } elseif ($platFormId == 10) {
            return view('admin.content.platformSEO.pinterest', compact('content', 'platUsedId'));
        } elseif ($platFormId == 11) {
            return view('admin.content.platformSEO.google-business', compact('content', 'platUsedId'));
        } elseif ($platFormId == 12) {
            return view('admin.content.platformSEO.dankash', compact('content', 'platUsedId'));
        } elseif ($platFormId == 13) {
            return view('admin.content.platformSEO.blog', compact('content', 'platUsedId'));
        } elseif ($platFormId == 14) {
            return view('admin.content.platformSEO.quora', compact('content', 'platUsedId'));
        } elseif ($platFormId == 15) {
            return view('admin.content.platformSEO.anchor', compact('content', 'platUsedId'));
        }
    }

    public function processPlanPlatform($platFormId, $planId, $platUsedId)
    {
        $content = Content::find($planId);
        if ($platFormId == 2) {
            $data['youtube_licenses'] = CStatus::where('module', '=', 'youtube_license')->get();
            $data['youtube_views'] = CStatus::where('module', '=', 'youtube_view')->get();
            $data['statuses'] = CStatus::where('id', 8)->get();
            return view('admin.content.platformProcess.youtube', compact('content', 'data', 'platFormId', 'platUsedId'));
        } elseif ($platFormId == 3) {
            $data['facebook_views'] = CStatus::where('module', '=', 'facebook_view')->get();
            return view('admin.content.platformProcess.facebook', compact('content', 'data', 'platUsedId'));
        } elseif ($platFormId == 4) {
            return view('admin.content.platformProcess.instagram', compact('content', 'platUsedId'));
        } elseif ($platFormId == 5) {
            return view('admin.content.platformProcess.Instagram-IGTV', compact('content', 'platUsedId'));
        } elseif ($platFormId == 6) {
            return view('admin.content.platformProcess.instagram-stories', compact('content', 'platUsedId'));
        } elseif ($platFormId == 7) {
            return view('admin.content.platformProcess.instagram-feeds', compact('content', 'platUsedId'));
        } elseif ($platFormId == 8) {
            return view('admin.content.platformProcess.twitter', compact('content', 'platUsedId'));
        } elseif ($platFormId == 9) {
            return view('admin.content.platformProcess.linkedIn', compact('content', 'platUsedId'));
        } elseif ($platFormId == 10) {
            return view('admin.content.platformProcess.pinterest', compact('content', 'platUsedId'));
        } elseif ($platFormId == 11) {
            return view('admin.content.platformProcess.google-business', compact('content', 'platUsedId'));
        } elseif ($platFormId == 12) {
            return view('admin.content.platformProcess.dankash', compact('content', 'platUsedId'));
        } elseif ($platFormId == 13) {
            return view('admin.content.platformProcess.blog', compact('content', 'platUsedId'));
        } elseif ($platFormId == 14) {
            return view('admin.content.platformProcess.quora', compact('content', 'platUsedId'));
        } elseif ($platFormId == 15) {
            return view('admin.content.platformProcess.anchor', compact('content', 'platUsedId'));
        }
    }


    public function downloadFile($expID)
    {
        $expense = CMedia::where('id', $expID)->firstOrFail();
        if ($expense->media) {
            $file = public_path() . $expense->media;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }
}
