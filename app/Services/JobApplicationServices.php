<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/13/2019
 * Time: 2:44 PM
 */

namespace App\Services;


use App\EmpHistory;
use App\Helpers\ImageHelpers;
use App\JobApplication;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Session;

class JobApplicationServices
{
    function __construct()
    {
        $this->jobApplicationsPagination = 20;
    }

    public function allJobApplications($request)
    {
        $allJobApplications = JobApplication::orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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
//        dd($request);
        $record = JobApplication::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if ($record) {
            Session::flash('message', 'Record Already Exist Check all Applicant with email!');
            Session::flash('alert', 'alert-danger');
            return redirect()->back();
        }
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
                $record1 = JobApplication::create(array_merge($request->except('_token', 'remarks'), [
                    'resume' => "/project-assets/files/" . $fileName,
                    'is_active' => 1,
                    'channel_id' => $channel_id,
                    'designation_id' => $designation_id,
                    'experience_id' => $experience_id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));

                if ($record1) {
                    EmpHistory::create(array_merge($request->except('_token'), [
                        'is_active' => 1,
                        'job_id' => $record1->id,
                        'call_id' => 18,
                        'remarks' => $request->remarks,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]));
                }
            } else {
                $record1 = JobApplication::create(array_merge($request->except('_token', 'remarks'), [
                    'is_active' => 1,
                    'channel_id' => $channel_id,
                    'designation_id' => $designation_id,
                    'experience_id' => $experience_id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
                if ($record1) {
                    EmpHistory::create(array_merge($request->except('_token'), [
                        'is_active' => 1,
                        'job_id' => $record1->id,
                        'call_id' => 18,
                        'remarks' => $request->remarks,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]));
                }
            }
        } else {
            return redirect()->back();
        }
    }

    public function jobApplicationsUpdate($request, $jobApplicantId)
    {
//        dd($request);
        $jobApplication = JobApplication::withoutGlobalScopes()->where('id', $jobApplicantId)->first();

        $history = EmpHistory::withoutGlobalScopes()->where('id', $request->his_id)->first();
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
            $record1 = $jobApplication->update(array_merge($request->except('_token'), [
                'resume' => "/project-assets/files/" . $fileName,
                'is_active' => 1,
                'channel_id' => $channel_id,
                'designation_id' => $designation_id,
                'experience_id' => $experience_id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]));
            if ($record1) {
                $history->update(array_merge($request->except('_token'), [
                    'is_active' => 1,
                    'call_id' => 18,
                    'remarks' => $request->remarks,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
            }
        } else {
            $record1 = $jobApplication->update(array_merge($request->except('_token'), [
                'is_active' => 1,
                'channel_id' => $channel_id,
                'designation_id' => $designation_id,
                'experience_id' => $experience_id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]));
            if ($record1) {
                $history->update(array_merge($request->except('_token'), [
                    'is_active' => 1,
                    'call_id' => 18,
                    'remarks' => $request->remarks,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
            }
        }
    }

    public function jobApplicationsPostApi($request)
    {

//dd($request->all());
        $record = JobApplication::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if ($record) {
            return response()->json(["data" => $record, 'message' => 'Data Already Exist']);
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
                $record1 = JobApplication::create([
                    'resume' => "/project-assets/files/" . $fileName,
                    'is_active' => 1,
                    'channel_id' => 8,
                    'designation_id' => $designation_id,
                    'experience_id' => $experience_id,
                    "apply_for" => $request->apply_for,
                    "name" => $request->name,
                    "email" => $request->email,
                    "user_phone" => $request->user_phone,
                    "skype_id" => $request->skype_id,
                    "address" => $request->address,
                    "city_name" => $request->city_name,
                    "expected_salary" => $request->expected_salary,
                ]);
                if ($record1) {
                    EmpHistory::create(array_merge($request->except('_token'), [
                        'is_active' => 1,
                        'job_id' => $record1->id,
                        'call_id' => 18,
                        'user_id' => 1,
                    ]));

                    if (!empty($request->resume)) {
                        $apply_for = $record1->apply_for;
                        $name1 = $record1->name;
                        $email = $record1->email;
                        $phone = $record1->user_phone;
                        $skype = $record1->skype_id;
                        $address = $record1->address;
                        $experience = $record1->experience->name;
                        $city = $record1->city_name;
                        $salary = $record1->expected_salary;
                        $resume = public_path($record1->resume);
                        $data = array('name' => $name1,
                            'apply_for' => $apply_for,
                            'email' => $email,
                            'phone' => $phone,
                            'skype' => $skype,
                            'address' => $address,
                            'experience' => $experience,
                            'city' => $city,
                            'salary' => $salary,
                        );
                        Mail::send('mail.job-applicant-mail', $data, function ($message) use ($resume, $request) {
                            $message->to('ishteeaq@gmail.com', 'Ishtiaq Haider')->subject('Job Application Data Form TechNerds');
                            $message->attach($resume);
                        });
                    }
////// for email to user

                    $designation = $record1->apply_for;
                    $name = $record1->name;
                    $to = $record1->email;
                    $data = array('name' => $name,
                        'designation' => $designation,
                    );
                    Mail::send('mail.job-portal', $data, function ($message) use ($to, $name) {
                        $message->to($to, $name)->subject
                        ('Thank you for applying at Tech Nerds');
                        $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                    });

                    return response()->json(["data" => $record1, 'message' => 'Form Submit Successfully'], 200);

                }

            }
        }
    }

}