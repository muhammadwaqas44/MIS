<?php
/**
 * Created by PhpStorm.
 * Date: 8/8/2019
 * Time: 3:00 PM
 */

namespace App\Services;


use App\CHistory;
use App\Content;
use App\CPlatformUsed;
use Carbon\Carbon;

class ContentServices
{
    function __construct()
    {
        $this->allContentsPagination = 20;
    }

    public function allPlans($request)
    {
        $allContents = Content::orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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
            'source' => $request->source,
            "produce_on" => $produce_on,
            "produce_by" => $request->produce_by,
            "process_on" => $process_on,
            "process_by" => $request->process_by,
            "publish_on" => $publish_on,
            "publish_by" => $request->publish_by,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);
        if ($content) {
            if (!empty($request->platform)) {
                foreach ($request->platform as $platform) {
                    CPlatformUsed::create([
                        'content_id' => $content->id,
                        'platform_id' => $platform,
                        'is_active' => 1,
                    ]);
                }
            }
            CHistory::create([
                'content_id' => $content->id,
                'c_status_id' => 1,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }
}