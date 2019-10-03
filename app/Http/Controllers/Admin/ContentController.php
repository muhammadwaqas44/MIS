<?php

namespace App\Http\Controllers\Admin;

use App\CHistory;
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
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::where('id', '!=', 1)->get();
        return view('admin.content.idea.add', compact('data'));
    }

    public function allIdeas(Request $request, ContentServices $contentServices)
    {

        $data['allIdeas'] = $contentServices->allIdeas($request);
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['addIdea', 'viewIdea'];
        $data['statuses'] = CStatus::whereIn('module', $module)->where('id', '!=', 3)->get();
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
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::where('id', '!=', 1)->get();
        $idea = Content::find($ideaId);
        $data['statuses'] = CStatus::withoutGlobalScopes()->whereIn('id', $stId)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $ideaId]])->get();


        return view('admin.content.idea.view', compact('idea', 'data'));
    }

    public function updateIdea(Request $request, $ideaId, ContentServices $contentServices)
    {
        $contentServices->updateIdea($request, $ideaId);
        return redirect()->route('admin.all-ideas');
    }

    public function allPlans(Request $request, ContentServices $contentServices)
    {
        $data['plans'] = $contentServices->allPlans($request);
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['viewIdea', 'addPlan', 'viewPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->where('id', '!=', 2)->get();
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
        $stId = [5, 6];
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['platforms'] = CPlatform::where('id', '!=', 1)->get();
        $data['statuses'] = CStatus::withoutGlobalScopes()->whereIn('id', $stId)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $planId]])->get();

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
        return redirect()->route('admin.all-plans');
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

    public function allContentGenerationView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['updatePlat', 'rectificationPlat'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $planId]])->get();
        return view('admin.content.process.view', compact('data', 'plan'));
    }

    public function allContentGeneration(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allContentGeneration'] = $contentServices->allContentGeneration($request);
        $module = ['processPlan', 'updatePlat', 'rectificationPlat', 'reviewRectificationPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->where([['id', '!=', 8], ['id', '!=', 10]])->get();
        return view('admin.content.process.list', compact('data'));
    }

    public function editProcessPost(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->viewContentPost($request, $planId);
        return redirect()->route('admin.all-content-generation');
    }

    public function allSEOList(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allContentGeneration'] = $contentServices->allContentGeneration($request);
        $module = ['processPlan', 'updatePlat', 'rectificationPlat', 'reviewRectificationPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->where([['id', '!=', 8], ['id', '!=', 10]])->get();
        return view('admin.content.seo.list', compact('data'));
    }

    public function seoView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['updatePlat', 'rectificationPlat'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $planId]])->get();
        return view('admin.content.seo.view', compact('data', 'plan'));
    }

    public function editSeoPost(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->viewContentPost($request, $planId);
        return redirect()->route('admin.all-seo');
    }

    public function allReview(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allReview'] = $contentServices->allReview($request);
        $module = ['updatePlat', 'rectificationPlat'];
        $data['statuses'] = CStatus::whereIn('module', $module)->where([['id', '!=', 7], ['id', '!=', 9]])->get();
        return view('admin.content.review.list', compact('data'));
    }

    public function allReviewView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['reviewRectificationPlan', 'reviewPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $planId]])->get();
        return view('admin.content.review.view', compact('data', 'plan'));
    }

    public function editReviewPost(Request $request, $planId, ContentServices $contentServices)
    {
//        dd($request->all());
        $contentServices->viewContentPost($request, $planId);
        return redirect()->route('admin.all-review');
    }

    public function allPublish(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allPublish'] = $contentServices->allPublish($request);
        $module = ['reviewPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        return view('admin.content.publish.list', compact('data'));
    }

    public function allContents(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['addIdea', 'viewIdea', 'viewIdea', 'addPlan', 'viewPlan', 'processPlan', 'updatePlat', 'rectificationPlat', 'rectificationPlat', 'reviewPlan', 'reviewRectificationPlan', 'publishPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        $data['allContents'] = $contentServices->allContents($request);
        return view('admin.content.all-content.list', compact('data'));
    }

    public function allPublishView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['publishPlan', 'reviewRectificationPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $planId]])->get();
        return view('admin.content.publish.view', compact('data', 'plan'));
    }

    public function editPublishPost(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->viewContentPost($request, $planId);
        return redirect()->route('admin.all-publish');
    }

    public function allPublished(Request $request, ContentServices $contentServices)
    {
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $data['allPublished'] = $contentServices->allPublished($request);
        $module = ['publishPlan', 'reviewRectificationPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        return view('admin.content.published.list', compact('data'));
    }

    public function allPublishedView($planId)
    {
        $plan = Content::find($planId);
        $data['users'] = Employee::all();
        $data['youtube'] = CYoutube::all();
        $data['category'] = ContentType::where('id', '!=', 1)->get();
        $module = ['publishedPlan', 'reviewRectificationPlan'];
        $data['statuses'] = CStatus::whereIn('module', $module)->get();
        $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', 1], ['plan_id', $planId]])->get();
//        dd($data);
        return view('admin.content.published.view', compact('data', 'plan'));
    }

    public function editPublishedPost(Request $request, $planId, ContentServices $contentServices)
    {
        $contentServices->viewContentPost($request, $planId);
        return redirect()->route('admin.all-published');
    }

    public function seoPlanPlatform($platFormId, $planId, $platUsedId)
    {
        $content = Content::find($planId);
        if ($platFormId == 2) {
            $data['youtube_licenses'] = CStatus::where('module', '=', 'youtube_license')->get();
            $data['youtube_views'] = CStatus::where('module', '=', 'youtube_view')->get();
            $module = ['updatePlat', 'rectificationPlat'];
            $data['statuses'] = CStatus::whereIn('module', $module)->get();
            $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', $platFormId], ['plan_id', $planId], ['type_module', 2]])->get();
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
            $module = ['updatePlat', 'rectificationPlat'];
            $data['statuses'] = CStatus::whereIn('module', $module)->get();
            $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', $platFormId], ['plan_id', $planId], ['type_module', 1]])->get();
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

    public function reviewPlanPlatform($platFormId, $planId, $platUsedId)
    {
        $content = Content::find($planId);
        if ($platFormId == 2) {
            $data['youtube_licenses'] = CStatus::where('module', '=', 'youtube_license')->get();
            $data['youtube_views'] = CStatus::where('module', '=', 'youtube_view')->get();
            $module = ['reviewRectificationPlan', 'reviewPlan'];
            $data['statuses'] = CStatus::whereIn('module', $module)->get();
            $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', $platFormId], ['plan_id', $planId], ['type_module', '!=', null]])->get();
            return view('admin.content.platformReview.youtube', compact('content', 'data', 'platFormId', 'platUsedId'));
        } elseif ($platFormId == 3) {
            $data['facebook_views'] = CStatus::where('module', '=', 'facebook_view')->get();
            return view('admin.content.platformReview.facebook', compact('content', 'data', 'platUsedId'));
        } elseif ($platFormId == 4) {
            return view('admin.content.platformReview.instagram', compact('content', 'platUsedId'));
        } elseif ($platFormId == 5) {
            return view('admin.content.platformReview.Instagram-IGTV', compact('content', 'platUsedId'));
        } elseif ($platFormId == 6) {
            return view('admin.content.platformReview.instagram-stories', compact('content', 'platUsedId'));
        } elseif ($platFormId == 7) {
            return view('admin.content.platformReview.instagram-feeds', compact('content', 'platUsedId'));
        } elseif ($platFormId == 8) {
            return view('admin.content.platformReview.twitter', compact('content', 'platUsedId'));
        } elseif ($platFormId == 9) {
            return view('admin.content.platformReview.linkedIn', compact('content', 'platUsedId'));
        } elseif ($platFormId == 10) {
            return view('admin.content.platformReview.pinterest', compact('content', 'platUsedId'));
        } elseif ($platFormId == 11) {
            return view('admin.content.platformReview.google-business', compact('content', 'platUsedId'));
        } elseif ($platFormId == 12) {
            return view('admin.content.platformReview.dankash', compact('content', 'platUsedId'));
        } elseif ($platFormId == 13) {
            return view('admin.content.platformReview.blog', compact('content', 'platUsedId'));
        } elseif ($platFormId == 14) {
            return view('admin.content.platformReview.quora', compact('content', 'platUsedId'));
        } elseif ($platFormId == 15) {
            return view('admin.content.platformReview.anchor', compact('content', 'platUsedId'));
        }
    }

    public function publishPlanPlatform($platFormId, $planId, $platUsedId)
    {
        $content = Content::find($planId);
        if ($platFormId == 2) {
            $data['youtube_licenses'] = CStatus::where('module', '=', 'youtube_license')->get();
            $data['youtube_views'] = CStatus::where('module', '=', 'youtube_view')->get();
            $module = ['publishPlan', 'reviewRectificationPlan'];
            $data['statuses'] = CStatus::whereIn('module', $module)->get();
            $data['history'] = CHistory::withoutGlobalScopes()->orderBy('id', 'desc')->where([['platform_used_id', $platFormId], ['plan_id', $planId], ['type_module', '!=', null]])->get();
            return view('admin.content.platformPublish.youtube', compact('content', 'data', 'platFormId', 'platUsedId'));
        } elseif ($platFormId == 3) {
            $data['facebook_views'] = CStatus::where('module', '=', 'facebook_view')->get();
            return view('admin.content.platformPublish.facebook', compact('content', 'data', 'platUsedId'));
        } elseif ($platFormId == 4) {
            return view('admin.content.platformPublish.instagram', compact('content', 'platUsedId'));
        } elseif ($platFormId == 5) {
            return view('admin.content.platformPublish.Instagram-IGTV', compact('content', 'platUsedId'));
        } elseif ($platFormId == 6) {
            return view('admin.content.platformPublish.instagram-stories', compact('content', 'platUsedId'));
        } elseif ($platFormId == 7) {
            return view('admin.content.platformPublish.instagram-feeds', compact('content', 'platUsedId'));
        } elseif ($platFormId == 8) {
            return view('admin.content.platformPublish.twitter', compact('content', 'platUsedId'));
        } elseif ($platFormId == 9) {
            return view('admin.content.platformPublish.linkedIn', compact('content', 'platUsedId'));
        } elseif ($platFormId == 10) {
            return view('admin.content.platformPublish.pinterest', compact('content', 'platUsedId'));
        } elseif ($platFormId == 11) {
            return view('admin.content.platformPublish.google-business', compact('content', 'platUsedId'));
        } elseif ($platFormId == 12) {
            return view('admin.content.platformPublish.dankash', compact('content', 'platUsedId'));
        } elseif ($platFormId == 13) {
            return view('admin.content.platformPublish.blog', compact('content', 'platUsedId'));
        } elseif ($platFormId == 14) {
            return view('admin.content.platformPublish.quora', compact('content', 'platUsedId'));
        } elseif ($platFormId == 15) {
            return view('admin.content.platformPublish.anchor', compact('content', 'platUsedId'));
        }
    }


    public function downloadFile($expID)
    {
        $expense = CMedia::where('id', $expID)->firstOrFail();
        if ($expense->media) {
            $file = public_path() . $expense->media;
//            $name = $expense->id . '-' . $file;
//            dd($name);
            return response()->download($file);
        } else {
            return 'File Does not Exist';
        }
    }
}
