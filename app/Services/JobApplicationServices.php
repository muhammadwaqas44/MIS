<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/13/2019
 * Time: 2:44 PM
 */

namespace App\Services;


use App\Helpers\ImageHelpers;
use App\JobApplication;

class JobApplicationServices
{
    function __construct()
    {
        $this->jobApplicationsPagination = 20;
    }

    public function allJobApplications($request)
    {
        $allJobApplications = JobApplication::withoutGlobalScopes()->orderBy('id', 'desc')->whereNull('deleted_at');

        if ($request->search_title) {
            $allJobApplications = $allJobApplications
                ->where('name', 'like', '%' . $request->search_title . '%')
                ->orWhere('email', 'like', '%' . $request->search_title . '%')
                ->orWhere('user_phone', 'like', '%' . $request->search_title . '%')
                ->orWhere('city_name', 'like', '%' . $request->search_title . '%')
                ->orWhere('address', 'like', '%' . $request->search_title . '%');
        }

        if ($request->filled('channel_id')) {
            $allJobApplications = $allJobApplications->where('channel_id', '=', $request->channel_id);
        }
        if ($request->filled('designation_id')) {
            $allJobApplications = $allJobApplications->where('designation_id', '=', $request->designation_id);
        }
        if ($request->filled('experience_id')) {
            $allJobApplications = $allJobApplications->where('experience_id', '=', $request->experience_id);
        }


        $data['allJobApplications'] = $allJobApplications->paginate($this->jobApplicationsPagination);
        return $data;
    }

    public function jobApplicationsPost($request)
    {
        $record = JobApplication::withoutGlobalScopes()->where('email', '=', $request->email)->first();

        if (!empty($request->channel_id)) {
            $channel_id = $request->channel_id;
        } else {
            $channel_id = 1;
        }
        if (!empty($request->designation_id)) {
            $designation_id = $request->designation_id;
        } else {
            $designation_id = 1;
        }
        if (!empty($request->experience_id)) {
            $experience_id = $request->experience_id;
        } else {
            $experience_id = 1;
        }
        if (!$record) {
            if (!empty($request->resume)) {
                $extension = $request->resume->getClientOriginalExtension();
                $fileName = time() . "-" . 'resume.' . $extension;
                ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
                JobApplication::create(array_merge($request->except('_token'), [
                    'resume' => "/project-assets/files/" . $fileName,
                    'is_active' => 1,
                    'channel_id' => $channel_id,
                    'designation_id' => $designation_id,
                    'experience_id' => $experience_id,
                ]));
            } else {
                JobApplication::create(array_merge($request->except('_token'), [
                    'is_active' => 1,
                    'channel_id' => $channel_id,
                    'designation_id' => $designation_id,
                    'experience_id' => $experience_id,
                ]));
            }
        } else {
            return redirect()->back();
        }
    }

    public function jobApplicationsUpdate($request, $jobApplicantId)
    {
        $jobApplication = JobApplication::withoutGlobalScopes()->where('id', $jobApplicantId)->first();
        if (!empty($request->channel_id)) {
            $channel_id = $request->channel_id;
        } else {
            $channel_id = 1;
        }
        if (!empty($request->designation_id)) {
            $designation_id = $request->designation_id;
        } else {
            $designation_id = 1;
        }
        if (!empty($request->experience_id)) {
            $experience_id = $request->experience_id;
        } else {
            $experience_id = 1;
        }
        if (!empty($request->resume)) {
            $extension = $request->resume->getClientOriginalExtension();
            $fileName = time() . "-" . 'resume.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
            $jobApplication->update(array_merge($request->except('_token'), [
                'resume' => "/project-assets/files/" . $fileName,
                'is_active' => 1,
                'channel_id' => $channel_id,
                'designation_id' => $designation_id,
                'experience_id' => $experience_id,
            ]));
        } else {
            $jobApplication->update(array_merge($request->except('_token'), [
                'is_active' => 1,
                'channel_id' => $channel_id,
                'designation_id' => $designation_id,
                'experience_id' => $experience_id,
            ]));
        }
    }

}