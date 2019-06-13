<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Designation;
use App\Experience;
use App\Services\JobApplicationServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobApplicationController extends Controller
{

    public function allJobApplications()
    {
        $data['channels'] = Channel::all();
        $data['experience'] = Experience::all();
        $data['designation'] = Designation::orderBy('name')->get();
        return view('admin.job_application.all-job-applications', compact('data'));

    }

    public function jobApplicationsPost(Request $request, JobApplicationServices $applicationServices)
    {
        $applicationServices->jobApplicationsPost($request);
        return redirect()->back();

    }
}
