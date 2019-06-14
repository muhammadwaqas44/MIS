<?php

namespace App\Http\Controllers\Admin;

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
        $data['channels'] = Channel::all();
        $data['experience'] = Experience::all();
        $data['designation'] = Designation::orderBy('name')->get();
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
        return response()->download($file);
    }

    public function deleteJobApplication($jobApplicantId)
    {
        $jobApplicant = JobApplication::where('id', $jobApplicantId)->firstOrFail();
        $jobApplicant->delete();
        return redirect()->back();
    }
}
