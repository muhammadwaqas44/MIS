<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Channel;
use App\Designation;
use App\Experience;
use App\JobApplication;
use App\Services\JobApplicationServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobApplicationController extends Controller
{

    public function allJobApplications(Request $request, JobApplicationServices $applicationServices)
    {
        $data['channels'] = Channel::where('id','!=',1)->get();
        $data['experience'] = Experience::where('id','!=',1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id','!=',1)->get();
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->whereNull('parent_id')->get();

        $data['allJobApplications'] = $applicationServices->allJobApplications($request);

        return view('admin.job_application.all-job-applications', compact('data'));
    }

    public function jobApplicationsPost(Request $request, JobApplicationServices $applicationServices)
    {
        $applicationServices->jobApplicationsPost($request);
        return redirect()->back();
    }

    public function downloadResumeApplicant($jobApplicantId)
    {
        $jobApplicant = JobApplication::where('id', $jobApplicantId)->firstOrFail();
        $file = public_path() . $jobApplicant->resume;
        return response()->file($file);
    }

    public function deleteJobApplication($jobApplicantId)
    {
        $jobApplicant = JobApplication::where('id', $jobApplicantId)->firstOrFail();
        $jobApplicant->delete();
        return redirect()->back();
    }

    public function jobApplicationsUpdate(Request $request, $jobApplicantId, JobApplicationServices $applicationServices)
    {
        $applicationServices->jobApplicationsUpdate($request, $jobApplicantId);
        return redirect()->back();
    }

}
