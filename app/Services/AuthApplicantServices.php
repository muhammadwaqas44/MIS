<?php
/**
 * Created by PhpStorm.
 * User: Waqas Rana
 * Date: 10/18/2019
 * Time: 5:52 PM
 */

namespace App\Services;


use App\EmpHistory;
use App\Employee;
use App\Helpers\ImageHelpers;
use App\Helpers\ResponseHelpers;
use App\JobApplication;
use App\Mail\ForgetPasswordMail;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthApplicantServices
{
    public function signUpApplicant($request)
    {


        $errorMessages = [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is not valid',
            'user_phone.required' => 'Phone Number is not valid',
            'apply_for.required' => 'Job Title is required',
            'city_name.required' => 'City is required',
            'experience_id.required' => 'Experience is required',
            'gender.required' => 'Gender is required',
            'resume.required' => 'Resume is required',
        ];
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'user_phone' => 'required|string',
                'city_name' => 'required|string',
                'apply_for' => 'required|string',
                'experience_id' => 'required|numeric',
                'gender' => 'required|string',
                'resume' => 'required|file',

            ], $errorMessages
        );
        if ($validator->fails()) {
//            return response()->json([$validator->messages()->first()], 200);
            return ResponseHelpers::jsonResponse(0, '', '', $validator->messages()->first());
        }

//        dd($request->all());

        $record = JobApplication::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if ($record) {
            $nameApply = $record->designation->name;
            return ResponseHelpers::jsonResponse(0, 'Data Already Exist', ["data" => $record, 'apply' => $nameApply], '', 200);
//            return response()->json(["data" => $record, 'apply' => $nameApply, 'message' => 'Data Already Exist']);
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

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $name = $first_name . ' ' . $last_name;
        $password = Str::random(6) . time();
//        dd($password, $name);
        if (!$record) {
            if (!empty($request->resume)) {
                $extension = $request->resume->getClientOriginalExtension();
                $fileName = time() . "-" . 'resume.' . $extension;
                ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
                $jobApplication = JobApplication::create([
                    'resume' => "/project-assets/files/" . $fileName,
                    'is_active' => 1,
                    'channel_id' => 8,
                    'designation_id' => $designation_id,
                    'experience_id' => $experience_id,
                    "apply_for" => $request->apply_for,
                    "name" => $name,
                    "email" => $request->email,
                    "user_phone" => $request->user_phone,
                    "city_name" => $request->city_name,
                ]);
                if ($jobApplication) {
                    EmpHistory::create(array_merge($request->except('_token'), [
                        'is_active' => 1,
                        'job_id' => $jobApplication->id,
                        'call_id' => 18,
                        'user_id' => 1,
                    ]));
                    $user = User::where('email', $request->email)->first();
                    if (!$user) {
                        User::create([
                            'is_active' => 1,
                            'role_id' => 5,
                            "first_name" => $request->first_name,
                            "last_name" => $request->last_name,
                            "email" => $request->email,
                            "user_phone" => $request->user_phone,
                            'password' => Hash::make($password),
                        ]);
                    }

                    $apply_for = $jobApplication->apply_for;
                    $name1 = $jobApplication->name;
                    $email = $jobApplication->email;
                    $phone = $jobApplication->user_phone;
                    $experience = $jobApplication->experience->name;
                    $city = $jobApplication->city_name;
                    $resume = public_path($jobApplication->resume);
                    $data = array('name' => $name1,
                        'apply_for' => $apply_for,
                        'email' => $email,
                        'phone' => $phone,
                        'skype' => null,
                        'address' => null,
                        'experience' => $experience,
                        'city' => $city,
                        'salary' => null,
                    );
                    Mail::send('mail.job-applicant-mail', $data, function ($message) use ($resume, $request) {
                        $message->to('vickyrana4433@gmail.com', 'Ishtiaq Haider')->subject('Job Application Data Form TechNerds');
                        $message->attach($resume);
                    });

                    ////// for email to user

                    $designation = $jobApplication->apply_for;
                    $name = $jobApplication->name;
                    $to = $jobApplication->email;
                    $data = array('name' => $name,
                        'designation' => $designation,
                        'email' => $to,
                        'password' => $password,
                    );
                    Mail::send('mail.signUp-job-portal', $data, function ($message) use ($to, $name) {
                        $message->from('hr@technerds.com', 'Tech Nerds');
                        $message->to($to, $name)->subject
                        ('Thank you for applying at Tech Nerds');
//                        $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                    });

                    return response()->json(["data" => $jobApplication, 'message' => 'Form Submit Successfully'], 200);

                }

            }
        }
    }


    public function forgetEmailPassword($request)
    {
        $errorMessages = [
            'email.required' => 'Email is required',
            'email.email' => 'Email format is not valid',
        ];
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|email',
            ], $errorMessages
        );
        if ($validator->fails()) {
            return ResponseHelpers::jsonResponse(0, '', '', $validator->messages()->first());
        }
        $user = User::where('email', $request->email)->first();
        $to = $user->email;
        $id = $user->id;
        if ($user) {
//            $forgettoken = Str::random(6) . time();

            Mail::to('vickyrana4433@gmail.com')->send(new ForgetPasswordMail($id));
//            $user->save();
            return ResponseHelpers::jsonResponse(1, 'Token sent to your email', ['id' => $id, 'email' => $to], '', 200);

        } else {
            return ResponseHelpers::jsonResponse(0, '', '', 'Email is not registered');
        }
    }

    public function getUserForPasswordReset($request, $userId)
    {
        $user = User::where('id', $userId)->delete();
        dd($user);
        return $user->email;
//
    }
}