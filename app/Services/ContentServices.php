<?php
/**
 * Created by PhpStorm.
 * Date: 8/8/2019
 * Time: 3:00 PM
 */

namespace App\Services;

use App\CHistory;
use App\CMedia;
use App\Content;
use App\CPlatformUsed;
use App\Helpers\ImageHelpers;
use Carbon\Carbon;

class ContentServices
{
    function __construct()
    {
        $this->allContentsPagination = 20;
    }


    public function allIdeas($request)
    {
        $allIdeas = Content::orderBy('id', 'desc')->where('is_active', 1);

        $data['allIdeas'] = $allIdeas->paginate($this->allContentsPagination);
        return $data;
    }

    public function postIdea($request)
    {
        $content = Content::create([
            'topic' => $request->topic,
            "tags" => $request->tags,
            "keywords" => $request->keywords,
            "reference_material" => $request->reference_material,
            'is_active' => 1,
            'created_by' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);
        if ($content) {

            CHistory::create([
                'plan_id' => $content->id,
                'platform_used_id' => 1,
                'c_status_id' => 1,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }

    public function updateIdea($request, $ideaId)
    {
        $content = Content::find($ideaId);
//        dd($request->all(), $ideaId);
        if ($content) {
            $content->topic = $request->topic;
            $content->tags = $request->tags;
            $content->keywords = $request->keywords;
            $content->reference_material = $request->reference_material;
            $content->created_by = auth()->user()->id;
            $content->save();
        }
        if (!empty($request->status_id)) {
            $status_id = $request->status_id;
        } else {
            $status_id = 1;
        }
        if ($request->status_id || $request->remarks) {
            if ($request->his_id) {
                $his = CHistory::find($request->his_id);
                if ($his->is_active == 1) {
                    $his->is_active = 0;
                    $his->save();
                }
            }
            CHistory::create([
                'plan_id' => $ideaId,
                'c_status_id' => $status_id,
                'platform_used_id' => 1,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);

        }

        if ($request->status_id == 3) {
            if ($content->is_active == 1) {
                $content->is_active = 0;
                $content->save();
            }
        }
    }

    public function allPlans($request)
    {

//        $allContents = Content::orderBy('id', 'desc')->where('is_active', 1);
        $allContents = CHistory::with(['c_status'])->whereHas('c_status', function ($query) {
            $stID = [3, 4, 5];
            $query->whereIn('id', $stID);
        })->orderBy('id', 'desc')->where([['is_active', 1], ['type_module', null]]);
//dd($allContents);
        if ($request->search_title) {
            $title = $request->search_title;
            $allContents = $allContents->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }


        $data['plans'] = $allContents->paginate($this->allContentsPagination);
        return $data;
    }

    public function postContentPlan($request)
    {
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '-1');
        ini_set('memory_limit', $normalMemoryLimit);
//        dd($request->all());
        if (!empty($request->produce_on)) {
            $produce_on = Carbon::parse(str_replace('-', '', $request->produce_on))->format('Y-m-d H:i:s');
        } else {
            $produce_on = null;
        }
        if (!empty($request->process_on)) {
            $process_on = Carbon::parse(str_replace('-', '', $request->process_on))->format('Y-m-d H:i:s');
        } else {
            $process_on = null;
        }
        if (!empty($request->publish_on)) {
            $publish_on = Carbon::parse(str_replace('-', '', $request->publish_on))->format('Y-m-d H:i:s');
        } else {
            $publish_on = null;
        }

        $content = Content::create([
            'topic' => $request->topic,
            'category_id' => $request->category_id,
            'is_active' => 1,
            'instructions' => $request->instructions,
            "produce_on" => $produce_on,
            "produce_by" => $request->produce_by,
            "process_on" => $process_on,
            "process_by" => $request->process_by,
            "publish_on" => $publish_on,
            "publish_by" => $request->publish_by,
            'created_by' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);
        if ($content) {
            if (!empty($request->platform)) {
                foreach ($request->platform as $platform) {
                    CPlatformUsed::create([
                        'plan_id' => $content->id,
                        'platform_id' => $platform,
                        'is_active' => 1,
                    ]);
                }
            }
            if (!empty($request->source)) {
                $folder = $content->id;
                $path = 'Contents/' . $folder;
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                foreach ($request->source as $source) {
                    $extension = $source->getClientOriginalExtension();
                    $fileName = microtime() . "-" . 'content.' . $extension;
                    ImageHelpers::uploadFile($path, $source, $fileName);
                    $image = $path . $fileName;
                    CMedia::create([
                        'plan_id' => $content->id,
                        'media' => $image,
                        'is_active' => 1,
                    ]);
                }
            }
            CHistory::create([
                'plan_id' => $content->id,
                'platform_used_id' => 1,
                'c_status_id' => 1,
                'is_active' => 1,
                'remarks' => $request->instructions,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }

    public function editPlanPost($request, $planId)
    {

        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '-1');
        ini_set('memory_limit', $normalMemoryLimit);
        $normal_post_max_size = ini_get('post_max_size');
        ini_set('post_max_size', '-1');
        ini_set('post_max_size', $normal_post_max_size);
        $normal_upload_max_filesize = ini_get('upload_max_filesize ');
        ini_set('upload_max_filesize ', '-1');
        ini_set('upload_max_filesize ', $normal_upload_max_filesize);

        $content = Content::find($planId);
//        dd($request->all());
        if (!empty($request->produce_on)) {
            $produce_on = Carbon::parse(str_replace('-', '', $request->produce_on))->format('Y-m-d H:i:s');
        } else {
            $produce_on = null;
        }
        if (!empty($request->process_on)) {
            $process_on = Carbon::parse(str_replace('-', '', $request->process_on))->format('Y-m-d H:i:s');
        } else {
            $process_on = null;
        }
        if (!empty($request->publish_on)) {
            $publish_on = Carbon::parse(str_replace('-', '', $request->publish_on))->format('Y-m-d H:i:s');
        } else {
            $publish_on = null;
        }

        if ($content) {
            $content->category_id = $request->category_id;
            $content->instructions = $request->instructions;
            $content->produce_on = $produce_on;
            $content->produce_by = $request->produce_by;
            $content->process_on = $process_on;
            $content->process_by = $request->process_by;
            $content->publish_on = $publish_on;
            $content->publish_by = $request->publish_by;
            $content->created_by = auth()->user()->id;
            $content->save();
        }

        if ($content) {
            if (!empty($request->platform)) {
                $platforms = $request->platform;
                $c_platformUsed = CPlatformUsed::where('plan_id', $planId)->get();
                foreach ($c_platformUsed as $plat) {
                    $plat->delete();
                }
                foreach ($platforms as $platform) {
                    CPlatformUsed::create([
                        'plan_id' => $planId,
                        'platform_id' => $platform,
                        'is_active' => 1,
                    ]);
                }
            }

            if (!empty($request->source)) {
                $folder = $content->id;
                $path = '/Contents/' . $folder . '/original/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                foreach ($request->source as $source) {
//                    dd($source);
//                    $extension = $source->getClientOriginalExtension();
                    $name = $source->getClientOriginalName();
//                    dd($name);
                    $fileName = $name;
//                    dd($fileName);
//                    $data [] = $fileName;
//                    return $data;
                    ImageHelpers::uploadFile($path, $source, $fileName);
                    $image = $path . $fileName;
//                    dd($image);
                    CMedia::create([
                        'plan_id' => $content->id,
                        'media' => $image,
                        'is_active' => 1,
                    ]);
                }
            }
            if (!empty($request->status_id)) {
                $status_id = $request->status_id;
            } else {
                $status_id = 4;
            }

            if ($request->his_id) {
                $his = CHistory::find($request->his_id);
                if ($his->is_active == 1) {
                    $his->is_active = 0;
                    $his->save();
                }
                CHistory::create([
                    'plan_id' => $planId,
                    'c_status_id' => $status_id,
                    'platform_used_id' => 1,
                    'is_active' => 1,
                    'remarks' => $request->remarks,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);

            }

            $CHistory = CHistory::where('plan_id', $planId)->firstOrFail();
            if ($CHistory) {
                $CHistory->plan_id = $planId;
                $CHistory->platform_used_id = 1;
                $CHistory->remarks = $request->instructions;
                $CHistory->created_by = auth()->user()->id;
                $CHistory->save();
            }

        }
    }

    public function producePlanPost($request, $planId)
    {
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '-1');
        ini_set('memory_limit', $normalMemoryLimit);
//        $normal_post_max_size = ini_get('post_max_size');
//        ini_set('post_max_size', '-1');
//        ini_set('post_max_size', $normal_post_max_size);
//        $normal_upload_max_filesize = ini_get('upload_max_filesize ');
//        ini_set('upload_max_filesize ', '-1');
//        ini_set('upload_max_filesize ', $normal_upload_max_filesize);
        $content = Content::find($planId);
//        dd($request->all());
        if (!empty($request->produce_on)) {
            $produce_on = Carbon::parse(str_replace('-', '', $request->produce_on))->format('Y-m-d H:i:s');
        } else {
            $produce_on = null;
        }
        if (!empty($request->process_on)) {
            $process_on = Carbon::parse(str_replace('-', '', $request->process_on))->format('Y-m-d H:i:s');
        } else {
            $process_on = null;
        }
        if (!empty($request->publish_on)) {
            $publish_on = Carbon::parse(str_replace('-', '', $request->publish_on))->format('Y-m-d H:i:s');
        } else {
            $publish_on = null;
        }

        if ($content) {
            $content->instructions = $request->instructions;
            $content->produce_on = $produce_on;
            $content->produce_by = $request->produce_by;
            $content->process_on = $process_on;
            $content->process_by = $request->process_by;
            $content->publish_on = $publish_on;
            $content->publish_by = $request->publish_by;
            $content->created_by = auth()->user()->id;
            $content->save();
        }

        if ($content) {
            if (!empty($request->platform)) {
                $platforms = $request->platform;
                $c_platformUsed = CPlatformUsed::where('plan_id', $planId)->get();
                foreach ($c_platformUsed as $plat) {
                    $plat->delete();
                }
                foreach ($platforms as $platform) {
                    CPlatformUsed::create([
                        'plan_id' => $planId,
                        'platform_id' => $platform,
                        'is_active' => 1,
                    ]);
                }
            }
            if (!empty($request->source)) {
                $folder = $content->id;
                $path = '/Contents/' . $folder . '/original/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                foreach ($request->source as $source) {
//                    dd($source);
//                    $extension = $source->getClientOriginalExtension();
                    $name = $source->getClientOriginalName();
//                    dd($name);
                    $fileName = $name;
//                    dd($fileName);
//                    $data [] = $fileName;
//                    return $data;
                    ImageHelpers::uploadFile($path, $source, $fileName);
                    $image = $path . $fileName;
//                    dd($image);
                    CMedia::create([
                        'plan_id' => $content->id,
                        'media' => $image,
                        'is_active' => 1,
                    ]);
                }
            }
        }
    }

    public function producePlanHistory($request, $planId)
    {
//        dd($request->all(), $planId);

        $content = CHistory::where([['plan_id', $planId], ['is_active', 1], ['platform_used_id', 1], ['type_module', null]])->firstOrfail();
//        dd($content);
        if ($content->is_active == 1) {
            $content->is_active = 0;
            $content->save();
        }
        if ($content->is_active == 0) {
            CHistory::create([
                'plan_id' => $planId,
                'c_status_id' => $request->status_id,
                'platform_used_id' => 1,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }


    public function allContentGeneration($request)
    {
        $allContentGeneration = CHistory::with(['c_status'])->whereHas('c_status', function ($query) {
            $stID = [6, 7];
            $query->whereIn('id', $stID);
        })->orderBy('id', 'desc')->where([['is_active', 1], ['platform_used_id', 1]]);


        $data['allContentGeneration'] = $allContentGeneration->paginate($this->allContentsPagination);
        return $data;
    }

    public function planHistory($request, $hisId)
    {
//        dd($request->all(), $planId);
        $content = CHistory::find($hisId);
        if ($content->is_active == 1) {
            $content->is_active = 0;
            $content->save();
        }
        if ($content->is_active == 0) {
            CHistory::create([
                'plan_id' => $content->id,
                'c_status_id' => $request->status_id,
                'platform_used_id' => 1,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'created_by' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }


    public function allReview($request)
    {
        $allContentGeneration = CHistory::with(['c_status'])->whereHas('c_status', function ($query) {
            $stID = [9];
            $query->whereIn('id', $stID);
        })->orderBy('id', 'desc')->where([['is_active', 1], ['platform_used_id', 1]]);


        $data['allReview'] = $allContentGeneration->paginate($this->allContentsPagination);
        return $data;
    }
}