<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Channel;
use App\Designation;
use App\EmpHistory;
use App\Experience;
use App\JobApplication;
use App\Services\JobApplicationServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{

    public function allJobApplications(Request $request, JobApplicationServices $applicationServices)
    {
        $data['channels'] = Channel::where('id', '!=', 1)->get();
        $data['experience'] = Experience::where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Call Status')->get();
        $data['allJobApplications'] = $applicationServices->allJobApplications($request);

        return view('admin.hiring.job_application.all-job-applications', compact('data'));
    }

    public function addJobApplications(Request $request, JobApplicationServices $applicationServices)
    {
        $data['channels'] = Channel::where('id', '!=', 1)->get();
        $data['experience'] = Experience::where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();

        return view('admin.hiring.job_application.add-job-application', compact('data'));
    }

    public function jobApplicationsPost(Request $request, JobApplicationServices $applicationServices)
    {
        $applicationServices->jobApplicationsPost($request);
        return redirect()->route('admin.all-job-application');
    }

    public function downloadResumeApplicant($jobApplicantId)
    {
        $jobApplicant = JobApplication::where('id', $jobApplicantId)->firstOrFail();
        if ($jobApplicant->resume) {
            $file = public_path() . $jobApplicant->resume;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function deleteJobApplication($jobApplicantId)
    {
        $jobApplicant = JobApplication::where('id', $jobApplicantId)->firstOrFail();
        $jobApplicant->delete();
        return redirect()->back();
    }

    public function editJobApplications($jobApplicantId)
    {
        $data['channels'] = Channel::where('id', '!=', 1)->get();
        $data['experience'] = Experience::where('id', '!=', 1)->get();
        $data['designation'] = Designation::orderBy('name')->where('id', '!=', 1)->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Call Status')->get();
        $jobApplication = JobApplication::find($jobApplicantId);

        return view('admin.hiring.job_application.edit-job-application', compact('data', 'jobApplication'));
    }

    public function addStatusApplication($jobApplicantId)
    {
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Call Status')->get();
        $jobApplication = JobApplication::find($jobApplicantId);
        return view('admin.hiring.job_application.add-status', compact('data', 'jobApplication'));
    }

    public function jobApplicationsUpdate(Request $request, $jobApplicantId, JobApplicationServices $applicationServices)
    {
        $applicationServices->jobApplicationsUpdate($request, $jobApplicantId);
        return redirect()->route('admin.all-job-application');
    }

    public function jobApplicationsPostApi(Request $request, JobApplicationServices $applicationServices)
    {

//dd($request->all());
        $hello = Validator::make($request->all(), [
            'apply_for' => 'required',
            'name' => 'required',
            'email' => 'required',
            'user_phone' => 'required',
            'address' => 'required',
            'city_name' => 'required',
            'expected_salary' => 'required',
            'experience_id' => 'required',
            'resume' => 'required',
        ]);
        if ($hello->fails()) {
//            $errorArray = array();
//            foreach(json_decode(json_encode($hello->errors())) as $key=>$error){
//                $errorArray[$key] =  $error[0];
//            }
//            $response = [
//                'response_code' => 2,
//                'message'=> 'Validation errors',
//                'data' => [],
//                'errors' => $errorArray,
//            ];
            return response()->json([$hello->errors(), 'message' => 'Validation errors'], 200);
        }
        return $applicationServices->jobApplicationsPostApi($request);


    }
}
