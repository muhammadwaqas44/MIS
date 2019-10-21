<?php
/**
 * Created by PhpStorm.
 * Date: 7/11/2019
 * Time: 8:11 PM
 */

namespace App\Services;

use App\EmpHistory;
use App\Employee;
use App\EmployeeHistroy;
use App\EmployeeOfficialDocument;
use App\EmployeePersonalDocument;
use App\Helpers\ImageHelpers;
use App\JobApplication;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class JoinEmployeeServices
{
    function __construct()
    {
        $this->allEmployeesPagination = 20;
    }

    public function allEmployees($request)
    {
        $allEmployees = Employee::orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allEmployees = $allEmployees->where('first_name', 'like', '%' . $title . '%')
                ->orWhere('last_name', 'like', '%' . $title . '%')
                ->orWhere('father_name', 'like', '%' . $title . '%')
                ->orWhere('email', 'like', '%' . $title . '%')
                ->orWhere('n_identity_no', 'like', '%' . $title . '%')
                ->orWhere('mobile_number', 'like', '%' . $title . '%')
                ->orWhere('secondary_number', 'like', '%' . $title . '%')
                ->orWhere('skype_id', 'like', '%' . $title . '%');

        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allEmployees = $allEmployees->whereBetween('created_at', [$start, $end]);

        }
        $data['allEmployees'] = $allEmployees->paginate($this->allEmployeesPagination);
        return $data;
    }

    public function postJoinEmployee($request)
    {
//        dd($request->all());
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $profile_image = "/project-assets/images/users/" . $fileName;
        } else {
            $profile_image = null;
        }
        if (!empty($request->resume)) {
            $extension = $request->resume->getClientOriginalExtension();
            $fileName = time() . "-" . 'resume.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
            $resume = "/project-assets/files/" . $fileName;
        } else {
            $resume = $request->resume_hide;
        }
        if (!empty($request->official_latter)) {
            $extension = $request->official_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'official_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('official_latter'), $fileName);
            $official_latter = "/project-assets/files/" . $fileName;
        } else {
            $official_latter = null;
        }
        if (!empty($request->joining_latter)) {
            $extension = $request->joining_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'joining_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('joining_latter'), $fileName);
            $joining_latter = "/project-assets/files/" . $fileName;
        } else {
            $joining_latter = null;
        }
        if (!empty($request->contract_paper)) {
            $extension = $request->contract_paper->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('contract_paper'), $fileName);
            $contract_paper = "/project-assets/files/" . $fileName;
        } else {
            $contract_paper = null;
        }
        if (!empty($request->date_of_birth)) {
            $date_of_birth = Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        if (!empty($request->joining_date)) {
            $joining_date = Carbon::parse(str_replace('-', '', $request->joining_date))->format('Y-m-d');
        } else {
            $joining_date = null;
        }
        if (!empty($request->nationality)) {
            $nationality = $request->nationality;
        } else {
            $nationality = 247;
        }
        if (!empty($request->current_country)) {
            $current_country = $request->current_country;
        } else {
            $current_country = 247;
        }
        if (!empty($request->permanent_country)) {
            $permanent_country = $request->permanent_country;
        } else {
            $permanent_country = 247;
        }
        if (!empty($request->current_state)) {
            $current_state = $request->current_state;
        } else {
            $current_state = 4122;
        }
        if (!empty($request->permanent_state)) {
            $permanent_state = $request->permanent_state;
        } else {
            $permanent_state = 4122;
        }
        if (!empty($request->permanent_city)) {
            $permanent_city = $request->permanent_city;
        } else {
            $permanent_city = 48357;
        }
        if (!empty($request->current_city)) {
            $current_city = $request->current_city;
        } else {
            $current_city = 48357;
        }
        if (!empty($request->probation_due_on)) {
            $probation_due_on = Carbon::parse(str_replace('-', '', $request->probation_due_on))->format('Y-m-d');
        } else {
            $probation_due_on = null;
        }
        if (!empty($request->review_id)) {
            $review_id = $request->review_id;
        } else {
            $review_id = 1;
        }
        if (!empty($request->remarks)) {
            $remarks_app = $request->remarks;
        } else {
            $remarks_app = 'Added Employee in Employment Module By HR';
        }
        if (!empty($request->is_active)) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        if (!empty($request->empHis_id)) {
            $empHis = EmpHistory::find($request->empHis_id);
            if ($empHis->is_active == 1) {
                $empHis->is_active = 0;
                $empHis->save();
            }
            if ($empHis->is_active == 0) {
                $empHisJ = EmpHistory::create([
                    'job_id' => $request->job_id,
                    'call_id' => 16,
                    'dateTime' => $joining_date,
                    'is_active' => 1,
                    'remarks' => $remarks_app,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
                if ($empHisJ) {
                    $joining_latter = public_path('/joining-latter/Office-Policy-2019.pdf');
                    $applicant = JobApplication::find($empHisJ->job_id);
                    $scheduleData = EmpHistory::find($empHisJ->id);
                    $name = $applicant->name;
                    $to = $applicant->email;
                    $data = array('name' => $name,
                    );
                    Mail::send('mail.joining-mail-emp', $data, function ($message) use ($to, $name, $joining_latter, $request) {
                        $message->from('hr@technerds.com', 'Tech Nerds');
                        $message->to($to, $name)->subject(' RE: Welcome to Tech Nerds');
                        $message->attach($joining_latter);
                                $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                    });
                }
            }
        }
        $record2 = Employee::where('email', $request->email)->first();
        if ($record2) {
            Session::flash('message', 'Record Already Exist Check all Applicant with email!');
            Session::flash('alert', 'alert-danger');
            return redirect()->back();
        }
        $employee = Employee::create([
            "job_id" => $request->job_id,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "date_of_birth" => $date_of_birth,
            "gender" => $request->gender,
            "marital_status" => $request->marital_status,
            "father_name" => $request->father_name,
            "nationality" => $nationality,
            "n_identity_type" => $request->n_identity_type,
            "n_identity_no" => $request->n_identity_no,
            "current_address" => $request->current_address,
            "current_city" => $current_city,
            "current_state" => $current_state,
            "current_country" => $current_country,
            "permanent_address" => $request->permanent_address,
            "permanent_city" => $permanent_city,
            "permanent_state" => $permanent_state,
            "permanent_country" => $permanent_country,
            "mobile_number" => $request->mobile_number,
            "secondary_number" => $request->secondary_number,
            "skype_id" => $request->skype_id,
            "email" => $request->email,
            "bank_name" => $request->bank_name,
            "branch_name" => $request->branch_name,
            "account_name" => $request->account_name,
            "account_no" => $request->account_no,
            "department_id" => $request->department_id,
            "designation_id" => $request->designation_id,
            "location_id" => $request->location_id,
            "profile_image" => $profile_image,
            "joining_date" => $joining_date,
            'probation_due_on' => $probation_due_on,
            'remarks' => $request->remarks,
            'review_id' => $review_id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
            'user_id' => auth()->user()->id,
            "is_active" => $is_active,
        ]);

        if ($employee) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                User::create([
                    'is_active' => 1,
                    'role_id' => 2,
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "email" => $request->email,
                    "user_phone" => $request->user_phone,
                    'password' => Hash::make('12345'),
                ]);
            }
            if (!empty($request->resume)) {
                EmployeePersonalDocument::create([
                    'path' => $resume,
                    'employee_id' => $employee->id,
                    'type' => 'resume'
                ]);
            }
            if (!empty($request->other_doc_personal)) {
                foreach ($request->other_doc_personal as $other_doc) {
                    $extension = $other_doc->getClientOriginalExtension();
                    $fileName = time() . "-." . $extension;
                    ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                    EmployeePersonalDocument::create([
                        'path' => '/project-assets/files/' . $fileName,
                        'employee_id' => $employee->id,
                        'type' => 'other_doc_personal'
                    ]);
                }
            }
            if (!empty($request->id_proof)) {
                foreach ($request->id_proof as $other_doc) {
                    $extension = $other_doc->getClientOriginalExtension();
                    $fileName = time() . "-." . $extension;
                    ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                    EmployeePersonalDocument::create([
                        'path' => '/project-assets/files/' . $fileName,
                        'employee_id' => $employee->id,
                        'type' => 'id_proof'
                    ]);
                }
            }
            if (!empty($request->official_latter)) {
                EmployeeOfficialDocument::create([
                    'path' => $official_latter,
                    'employee_id' => $employee->id,
                    'type' => 'official_latter'
                ]);

            }
            if (!empty($request->joining_latter)) {
                EmployeeOfficialDocument::create([
                    'path' => $joining_latter,
                    'employee_id' => $employee->id,
                    'type' => 'joining_latter'
                ]);
            }
            if (!empty($request->contract_paper)) {
                EmployeeOfficialDocument::create([
                    'path' => $contract_paper,
                    'employee_id' => $employee->id,
                    'type' => 'contract_paper'
                ]);
            }
            if (!empty($request->other_doc_official)) {
                foreach ($request->other_doc_official as $other_doc) {
                    $extension = $other_doc->getClientOriginalExtension();
                    $fileName = time() . "-." . $extension;
                    ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                    EmployeeOfficialDocument::create([
                        'path' => '/project-assets/files/' . $fileName,
                        'employee_id' => $employee->id,
                        'type' => 'other_doc_official'
                    ]);
                }
            }
            $employee_histroy = EmployeeHistroy::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "date_of_birth" => $date_of_birth,
                "gender" => $request->gender,
                "marital_status" => $request->marital_status,
                "father_name" => $request->father_name,
                "nationality" => $nationality,
                "n_identity_type" => $request->n_identity_type,
                "n_identity_no" => $request->n_identity_no,
                "current_address" => $request->current_address,
                "current_city" => $current_city,
                "current_state" => $current_state,
                "current_country" => $current_country,
                "permanent_address" => $request->permanent_address,
                "permanent_city" => $permanent_city,
                "permanent_state" => $permanent_state,
                "permanent_country" => $permanent_country,
                "mobile_number" => $request->mobile_number,
                "secondary_number" => $request->secondary_number,
                "skype_id" => $request->skype_id,
                "email" => $request->email,
                "bank_name" => $request->bank_name,
                "branch_name" => $request->branch_name,
                "account_name" => $request->account_name,
                "account_no" => $request->account_no,
                "department_id" => $request->department_id,
                "designation_id" => $request->designation_id,
                "location_id" => $request->location_id,
                "profile_image" => $profile_image,
                "joining_date" => $joining_date,
                'created_at' => Carbon::now()->timezone(session('timezone')),
                "job_id" => $request->job_id,
                "employee_id" => $employee->id,
                'probation_due_on' => $probation_due_on,
                'remarks' => $request->remarks,
                'review_id' => $review_id,
                'user_id' => auth()->user()->id,
                "is_active" => 1,
            ]);
        }
    }

    public function addEmployeePost($request)
    {
//        dd($request->all());

        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $profile_image = "/project-assets/images/users/" . $fileName;
        } else {
            $profile_image = null;
        }
        if (!empty($request->resume)) {
            $extension = $request->resume->getClientOriginalExtension();
            $fileName = time() . "-" . 'resume.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
            $resume = "/project-assets/files/" . $fileName;
        } else {
            $resume = $request->resume_hide;
        }
        if (!empty($request->official_latter)) {
            $extension = $request->official_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'official_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('official_latter'), $fileName);
            $official_latter = "/project-assets/files/" . $fileName;
        } else {
            $official_latter = null;
        }
        if (!empty($request->joining_latter)) {
            $extension = $request->joining_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'joining_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('joining_latter'), $fileName);
            $joining_latter = "/project-assets/files/" . $fileName;
        } else {
            $joining_latter = null;
        }
        if (!empty($request->contract_paper)) {
            $extension = $request->contract_paper->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('contract_paper'), $fileName);
            $contract_paper = "/project-assets/files/" . $fileName;
        } else {
            $contract_paper = null;
        }
        if (!empty($request->date_of_birth)) {
            $date_of_birth = Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        if (!empty($request->joining_date)) {
            $joining_date = Carbon::parse(str_replace('-', '', $request->joining_date))->format('Y-m-d');
        } else {
            $joining_date = null;
        }
        if (!empty($request->nationality)) {
            $nationality = $request->nationality;
        } else {
            $nationality = 247;
        }
        if (!empty($request->current_country)) {
            $current_country = $request->current_country;
        } else {
            $current_country = 247;
        }
        if (!empty($request->permanent_country)) {
            $permanent_country = $request->permanent_country;
        } else {
            $permanent_country = 247;
        }
        if (!empty($request->current_state)) {
            $current_state = $request->current_state;
        } else {
            $current_state = 4122;
        }
        if (!empty($request->permanent_state)) {
            $permanent_state = $request->permanent_state;
        } else {
            $permanent_state = 4122;
        }
        if (!empty($request->permanent_city)) {
            $permanent_city = $request->permanent_city;
        } else {
            $permanent_city = 48357;
        }
        if (!empty($request->current_city)) {
            $current_city = $request->current_city;
        } else {
            $current_city = 48357;
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
        if (!empty($request->probation_due_on)) {
            $probation_due_on = Carbon::parse(str_replace('-', '', $request->probation_due_on))->format('Y-m-d');
        } else {
            $probation_due_on = null;
        }
        if (!empty($request->review_id)) {
            $review_id = $request->review_id;
        } else {
            $review_id = 1;
        }
        if (!empty($request->remarks)) {
            $remarks_app = $request->remarks;
        } else {
            $remarks_app = 'Added Employee in Employment Module By HR';
        }
        if (!empty($request->is_active)) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        $record = JobApplication::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if ($record) {
            Session::flash('message', 'Record Already Exist Check all Applicant with email!');
            Session::flash('alert', 'alert-danger');
            return redirect()->back();
        }

        if (!$record) {
            $record1 = JobApplication::create([
                'resume' => $resume,
                'is_active' => 0,
                'channel_id' => $channel_id,
                'designation_id' => $designation_id,
                'experience_id' => $experience_id,
                "apply_for" => $request->apply_for,
                "name" => $request->first_name . " " . $request->last_name,
                "email" => $request->email,
                "user_phone" => $request->mobile_number,
                "skype_id" => $request->skype_id,
                "address" => $request->current_address,
                "expected_salary" => $request->expected_salary,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
            if ($record1) {
                $empHis = EmpHistory::create([
                    'is_active' => 0,
                    'job_id' => $record1->id,
                    'call_id' => 18,
                    'remarks' => 'Added Employee in Employment Module By HR',
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]);
                $empHisID = $empHis->id;
                $empHis = EmpHistory::find($empHisID);
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    $empHisJ = EmpHistory::create([
                        'job_id' => $record1->id,
                        'call_id' => 16,
                        'dateTime' => $joining_date,
                        'is_active' => 1,
                        'remarks' => $remarks_app,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                    if ($empHisJ) {
                        $joining_latter = public_path('/joining-latter/Office-Policy-2019.pdf');
                        $applicant = JobApplication::find($empHisJ->job_id);
                        $scheduleData = EmpHistory::find($empHisJ->id);
                        $name = $applicant->name;
                        $to = $applicant->email;
                        $data = array('name' => $name,
                        );
                        Mail::send('mail.joining-mail-emp', $data, function ($message) use ($to, $name, $joining_latter, $request) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject(' RE: Welcome to Tech Nerds');
                            $message->attach($joining_latter);
                                $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
                    }
                }
                $job_id_app = $record1->id;
                $record4 = Employee::withoutGlobalScopes()->where('email', $request->email)->first();
//                dd($record4);
                if ($record4) {
                    Session::flash('message', 'Record Already Exist Check all Employment list with email!..');
                    Session::flash('alert', 'alert-danger');
                    return redirect()->back();
                }
                if (!$record4) {
                    $employee = Employee::create([
                        "job_id" => $job_id_app,
                        "first_name" => $request->first_name,
                        "last_name" => $request->last_name,
                        "date_of_birth" => $date_of_birth,
                        "gender" => $request->gender,
                        "marital_status" => $request->marital_status,
                        "father_name" => $request->father_name,
                        "nationality" => $nationality,
                        "n_identity_type" => $request->n_identity_type,
                        "n_identity_no" => $request->n_identity_no,
                        "current_address" => $request->current_address,
                        "current_city" => $current_city,
                        "current_state" => $current_state,
                        "current_country" => $current_country,
                        "permanent_address" => $request->permanent_address,
                        "permanent_city" => $permanent_city,
                        "permanent_state" => $permanent_state,
                        "permanent_country" => $permanent_country,
                        "mobile_number" => $request->mobile_number,
                        "secondary_number" => $request->secondary_number,
                        "skype_id" => $request->skype_id,
                        "email" => $request->email,
                        "bank_name" => $request->bank_name,
                        "branch_name" => $request->branch_name,
                        "account_name" => $request->account_name,
                        "account_no" => $request->account_no,
                        "department_id" => $request->department_id,
                        "designation_id" => $request->designation_id,
                        "location_id" => $request->location_id,
                        "profile_image" => $profile_image,
                        "joining_date" => $joining_date,
                        'probation_due_on' => $probation_due_on,
                        'remarks' => $request->remarks,
                        'review_id' => $review_id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                        'user_id' => auth()->user()->id,
                        "is_active" => $is_active,
                    ]);
                    if ($employee) {
                        $user = User::where('email', $request->email)->first();
                        if (!$user) {
                            User::create([
                                'is_active' => 1,
                                'role_id' => 2,
                                "first_name" => $request->first_name,
                                "last_name" => $request->last_name,
                                "email" => $request->email,
                                "user_phone" => $request->user_phone,
                                'password' => Hash::make('12345'),
                            ]);
                        }
                        if (!empty($request->resume)) {
                            EmployeePersonalDocument::create([
                                'path' => $resume,
                                'employee_id' => $employee->id,
                                'type' => 'resume'
                            ]);
                        }
                        if (!empty($request->other_doc_personal)) {
                            foreach ($request->other_doc_personal as $other_doc) {
                                $extension = $other_doc->getClientOriginalExtension();
                                $fileName = time() . "-." . $extension;
                                ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                                EmployeePersonalDocument::create([
                                    'path' => '/project-assets/files/' . $fileName,
                                    'employee_id' => $employee->id,
                                    'type' => 'other_doc_personal'
                                ]);
                            }
                        }
                        if (!empty($request->id_proof)) {
                            foreach ($request->id_proof as $other_doc) {
                                $extension = $other_doc->getClientOriginalExtension();
                                $fileName = time() . "-." . $extension;
                                ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                                EmployeePersonalDocument::create([
                                    'path' => '/project-assets/files/' . $fileName,
                                    'employee_id' => $employee->id,
                                    'type' => 'id_proof'
                                ]);
                            }
                        }
                        if (!empty($request->official_latter)) {
                            EmployeeOfficialDocument::create([
                                'path' => $official_latter,
                                'employee_id' => $employee->id,
                                'type' => 'official_latter'
                            ]);

                        }
                        if (!empty($request->joining_latter)) {
                            EmployeeOfficialDocument::create([
                                'path' => $joining_latter,
                                'employee_id' => $employee->id,
                                'type' => 'joining_latter'
                            ]);
                        }
                        if (!empty($request->contract_paper)) {
                            EmployeeOfficialDocument::create([
                                'path' => $contract_paper,
                                'employee_id' => $employee->id,
                                'type' => 'contract_paper'
                            ]);
                        }
                        if (!empty($request->other_doc_official)) {
                            foreach ($request->other_doc_official as $other_doc) {
                                $extension = $other_doc->getClientOriginalExtension();
                                $fileName = time() . "-." . $extension;
                                ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                                EmployeeOfficialDocument::create([
                                    'path' => '/project-assets/files/' . $fileName,
                                    'employee_id' => $employee->id,
                                    'type' => 'other_doc_official'
                                ]);
                            }
                        }
                        $employee_histroy = EmployeeHistroy::create([
                            "first_name" => $request->first_name,
                            "last_name" => $request->last_name,
                            "date_of_birth" => $date_of_birth,
                            "gender" => $request->gender,
                            "marital_status" => $request->marital_status,
                            "father_name" => $request->father_name,
                            "nationality" => $nationality,
                            "n_identity_type" => $request->n_identity_type,
                            "n_identity_no" => $request->n_identity_no,
                            "current_address" => $request->current_address,
                            "current_city" => $current_city,
                            "current_state" => $current_state,
                            "current_country" => $current_country,
                            "permanent_address" => $request->permanent_address,
                            "permanent_city" => $permanent_city,
                            "permanent_state" => $permanent_state,
                            "permanent_country" => $permanent_country,
                            "mobile_number" => $request->mobile_number,
                            "secondary_number" => $request->secondary_number,
                            "skype_id" => $request->skype_id,
                            "email" => $request->email,
                            "bank_name" => $request->bank_name,
                            "branch_name" => $request->branch_name,
                            "account_name" => $request->account_name,
                            "account_no" => $request->account_no,
                            "department_id" => $request->department_id,
                            "designation_id" => $request->designation_id,
                            "location_id" => $request->location_id,
                            "profile_image" => $profile_image,
                            "joining_date" => $joining_date,
                            'created_at' => Carbon::now()->timezone(session('timezone')),
                            "job_id" => $job_id_app,
                            "employee_id" => $employee->id,
                            'probation_due_on' => $probation_due_on,
                            'remarks' => $request->remarks,
                            'review_id' => $review_id,
                            'user_id' => auth()->user()->id,
                            "is_active" => 1,
                        ]);
                    }
                }
            }
        }

    }

    public function updateEmployee($request, $employeeId)
    {
//        dd($request->all());
        $employee = Employee::withoutGlobalScopes()->find($employeeId);
        if (!empty($request->profile_image)) {
            $fileName = time() . "-" . 'profile_image' . ".png";
            ImageHelpers::updateProfileImage('/project-assets/images/users/', $request->file('profile_image'), $fileName);
            $profile_image = "/project-assets/images/users/" . $fileName;
        } else {
            $profile_image = $request->profile_image_hide;
        }
        if (!empty($request->resume)) {
            $extension = $request->resume->getClientOriginalExtension();
            $fileName = time() . "-" . 'resume.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
            $resume = "/project-assets/files/" . $fileName;
        } else {
            $resume = $request->resume_hide;
        }
        if (!empty($request->official_latter)) {
            $extension = $request->official_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'official_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('official_latter'), $fileName);
            $official_latter = "/project-assets/files/" . $fileName;
        } else {
            $official_latter = $request->official_latter_hide;
        }
        if (!empty($request->joining_latter)) {
            $extension = $request->joining_latter->getClientOriginalExtension();
            $fileName = time() . "-" . 'joining_latter.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('joining_latter'), $fileName);
            $joining_latter = "/project-assets/files/" . $fileName;
        } else {
            $joining_latter = $request->joining_latter_hide;
        }
        if (!empty($request->contract_paper)) {
            $extension = $request->contract_paper->getClientOriginalExtension();
            $fileName = time() . "-" . 'contract_paper.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('contract_paper'), $fileName);
            $contract_paper = "/project-assets/files/" . $fileName;
        } else {
            $contract_paper = $request->contract_paper_hide;
        }
        if (!empty($request->job_id)) {
            $job_id = $request->job_id;
        } else {
            $job_id = null;
        }
        if (!empty($request->date_of_birth)) {
            $date_of_birth = Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        if (!empty($request->joining_date)) {
            $joining_date = Carbon::parse(str_replace('-', '', $request->joining_date))->format('Y-m-d');
        } else {
            $joining_date = null;
        }
        if (!empty($request->probation_due_on)) {
            $probation_due_on = Carbon::parse(str_replace('-', '', $request->probation_due_on))->format('Y-m-d');
        } else {
            $probation_due_on = null;
        }
        if (!empty($request->review_id)) {
            $review_id = $request->review_id;
        } else {
            $review_id = 1;
        }
        if (!empty($request->nationality)) {
            $nationality = $request->nationality;
        } else {
            $nationality = 247;
        }
        if (!empty($request->current_country)) {
            $current_country = $request->current_country;
        } else {
            $current_country = 247;
        }
        if (!empty($request->permanent_country)) {
            $permanent_country = $request->permanent_country;
        } else {
            $permanent_country = 247;
        }
        if (!empty($request->current_state)) {
            $current_state = $request->current_state;
        } else {
            $current_state = 4122;
        }
        if (!empty($request->permanent_state)) {
            $permanent_state = $request->permanent_state;
        } else {
            $permanent_state = 4122;
        }
        if (!empty($request->permanent_city)) {
            $permanent_city = $request->permanent_city;
        } else {
            $permanent_city = 48357;
        }
        if (!empty($request->current_city)) {
            $current_city = $request->current_city;
        } else {
            $current_city = 48357;
        }
        if (!empty($request->is_active)) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        ///// FOR UPDATE STATUSES IN ALL APPLICANT MODULE
        if ($employee->first_name == $request->first_name) {
            $first_name_status = null;
        } else {
            $first_name_status = 23;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $first_name_status,
                        'is_active' => 1,
                        'remarks' => $employee->first_name,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->last_name == $request->last_name) {
            $last_name_status = null;
        } else {
            $last_name_status = 24;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $last_name_status,
                        'is_active' => 1,
                        'remarks' => $employee->last_name,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->date_of_birth == $request->date_of_birth) {
            $date_of_birth_status = null;
        } else {
            $date_of_birth_status = 25;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $date_of_birth_status,
                        'is_active' => 1,
                        'remarks' => $employee->date_of_birth,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->gender == $request->gender) {
            $gender_status = null;
        } else {
            $gender_status = 26;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $gender_status,
                        'is_active' => 1,
                        'remarks' => $employee->gender,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->marital_status == $request->marital_status) {
            $marital_status_status = null;
        } else {
            $marital_status_status = 27;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $marital_status_status,
                        'is_active' => 1,
                        'remarks' => $employee->marital_status,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->father_name == $request->father_name) {
            $father_name_status = null;
        } else {
            $father_name_status = 28;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $father_name_status,
                        'is_active' => 1,
                        'remarks' => $employee->father_name,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->nationality == $request->nationality) {
            $nationality_status = null;
        } else {
            $nationality_status = 29;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->nationalityCountry->name)) {
                    $nationality_ch = $employee->nationalityCountry->name;
                } else {
                    $nationality_ch = 'Has No Nationality';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $nationality_status,
                        'is_active' => 1,
                        'remarks' => $nationality_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->n_identity_type == $request->n_identity_type) {
            $n_identity_type_status = null;
        } else {
            $n_identity_type_status = 30;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $n_identity_type_status,
                        'is_active' => 1,
                        'remarks' => $employee->n_identity_type,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->n_identity_no == $request->n_identity_no) {
            $n_identity_no_status = null;
        } else {
            $n_identity_no_status = 31;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $n_identity_no_status,
                        'is_active' => 1,
                        'remarks' => $employee->n_identity_no,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->current_address == $request->current_address) {
            $current_address_status = null;
        } else {
            $current_address_status = 32;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $current_address_status,
                        'is_active' => 1,
                        'remarks' => $employee->current_address,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->current_country == $request->current_country) {
            $current_country_status = null;
        } else {
            $current_country_status = 33;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->currentCountry->name)) {
                    $current_country_ch = $employee->currentCountry->name;
                } else {
                    $current_country_ch = 'Has No Current Country';
                }

                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $current_country_status,
                        'is_active' => 1,
                        'remarks' => $current_country_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->current_state == $request->current_state) {
            $current_state_status = null;
        } else {
            $current_state_status = 34;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->currentState->name)) {
                    $current_state_ch = $employee->currentState->name;
                } else {
                    $current_state_ch = 'Has No Current State';
                }

                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $current_state_status,
                        'is_active' => 1,
                        'remarks' => $current_state_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->current_city == $request->current_city) {
            $current_city_status = null;
        } else {
            $current_city_status = 35;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->currentCity->name)) {
                    $current_city_ch = $employee->currentCity->name;
                } else {
                    $current_city_ch = 'Has No Current City';
                }

                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $current_city_status,
                        'is_active' => 1,
                        'remarks' => $current_city_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->permanent_address == $request->permanent_address) {
            $permanent_address_status = null;
        } else {
            $permanent_address_status = 36;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $permanent_address_status,
                        'is_active' => 1,
                        'remarks' => $employee->permanent_address,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->permanent_country == $request->permanent_country) {
            $permanent_country_status = null;
        } else {
            $permanent_country_status = 37;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->permanentCountry->name)) {
                    $permanent_country_ch = $employee->permanentCountry->name;
                } else {
                    $permanent_country_ch = 'Has No Permanent Country';
                }

                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $permanent_country_status,
                        'is_active' => 1,
                        'remarks' => $permanent_country_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->permanent_state == $request->permanent_state) {
            $permanent_state_status = null;
        } else {
            $permanent_state_status = 38;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->permanentState->name)) {
                    $permanent_state_ch = $employee->permanentState->name;
                } else {
                    $permanent_state_ch = 'Has No Permanent State';
                }

                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $permanent_state_status,
                        'is_active' => 1,
                        'remarks' => $permanent_state_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->permanent_city == $request->permanent_city) {
            $permanent_city_status = null;
        } else {
            $permanent_city_status = 39;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->permanentCity->name)) {
                    $permanent_city_ch = $employee->permanentCity->name;
                } else {
                    $permanent_city_ch = 'Has No Permanent City';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $permanent_city_status,
                        'is_active' => 1,
                        'remarks' => $permanent_city_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->mobile_number == $request->mobile_number) {
            $mobile_number_status = null;
        } else {
            $mobile_number_status = 40;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $mobile_number_status,
                        'is_active' => 1,
                        'remarks' => $employee->mobile_number,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->secondary_number == $request->secondary_number) {
            $secondary_number_status = null;
        } else {
            $secondary_number_status = 41;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $secondary_number_status,
                        'is_active' => 1,
                        'remarks' => $employee->secondary_number,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->skype_id == $request->skype_id) {
            $skype_id_status = null;
        } else {
            $skype_id_status = 42;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $skype_id_status,
                        'is_active' => 1,
                        'remarks' => $employee->skype_id,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->email == $request->email) {
            $email_status = null;
        } else {
            $email_status = 43;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $email_status,
                        'is_active' => 1,
                        'remarks' => $employee->email,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->bank_name == $request->bank_name) {
            $bank_name_status = null;
        } else {
            $bank_name_status = 52;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $bank_name_status,
                        'is_active' => 1,
                        'remarks' => $employee->bank_name,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->branch_name == $request->branch_name) {
            $branch_name_status = null;
        } else {
            $branch_name_status = 53;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $branch_name_status,
                        'is_active' => 1,
                        'remarks' => $employee->branch_name,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->account_name == $request->account_name) {
            $account_name_status = null;
        } else {
            $account_name_status = 54;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $account_name_status,
                        'is_active' => 1,
                        'remarks' => $employee->account_name,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->account_no == $request->account_no) {
            $account_no_status = null;
        } else {
            $account_no_status = 55;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $account_no_status,
                        'is_active' => 1,
                        'remarks' => $employee->account_no,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->department_id == $request->department_id) {
            $department_id_status = null;
        } else {
            $department_id_status = 56;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->departmentName->name)) {
                    $department_id_ch = $employee->departmentName->name;
                } else {
                    $department_id_ch = 'Has No Department';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $department_id_status,
                        'is_active' => 1,
                        'remarks' => $department_id_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->designation_id == $request->designation_id) {
            $designation_id_status = null;
        } else {
            $designation_id_status = 57;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->designationName->name)) {
                    $designation_id_ch = $employee->designationName->name;
                } else {
                    $designation_id_ch = 'Has No Designation';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $designation_id_status,
                        'is_active' => 1,
                        'remarks' => $designation_id_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->location_id == $request->location_id) {
            $location_id_status = null;
        } else {
            $location_id_status = 58;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->locationName->name)) {
                    $location_id_ch = $employee->locationName->name;
                } else {
                    $location_id_ch = 'Has No Location';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $location_id_status,
                        'is_active' => 1,
                        'remarks' => $location_id_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->joining_date == $request->joining_date) {
            $joining_date_status = null;
        } else {
            $joining_date_status = 59;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $joining_date_status,
                        'is_active' => 1,
                        'remarks' => $employee->joining_date,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($employee->profile_image == $profile_image) {
            $profile_image_status = null;
        } else {
            $profile_image_status = 44;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }

                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $profile_image_status,
                        'is_active' => 1,
                        'remarks' => $employee->profile_image,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($request->resume) {
            $resume_status = 45;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->employeePersonalDoc->resume)) {
                    $resume_ch = $employee->employeePersonalDoc->resume;
                } else {
                    $resume_ch = 'Has No Resume';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $resume_status,
                        'is_active' => 1,
                        'remarks' => $resume_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($request->id_proof) {
            $id_proof_status = 46;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->employeePersonalDoc->id_proof)) {
                    $id_proof_ch = $employee->employeePersonalDoc->id_proof;
                } else {
                    $id_proof_ch = 'Has No Id Proof';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $id_proof_status,
                        'is_active' => 1,
                        'remarks' => $id_proof_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($request->official_latter) {
            $official_latter_status = 48;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->employeeOfficialDoc->official_latter)) {
                    $official_latter_ch = $employee->employeeOfficialDoc->official_latter;
                } else {
                    $official_latter_ch = 'Has No Official Latter';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $official_latter_status,
                        'is_active' => 1,
                        'remarks' => $official_latter_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($request->contract_paper) {
            $contract_paper_status = 50;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->employeeOfficialDoc->contract_paper)) {
                    $contract_paper_ch = $employee->employeeOfficialDoc->contract_paper;
                } else {
                    $contract_paper_ch = 'Has No Contract Paper';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $contract_paper_status,
                        'is_active' => 1,
                        'remarks' => $contract_paper_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }
        if ($request->joining_latter) {
            $joining_latter_status = 49;
            $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
            if ($empHis) {
                if ($empHis->is_active == 1) {
                    $empHis->is_active = 0;
                    $empHis->save();
                }
                if (isset($employee->employeeOfficialDoc->joining_latter)) {
                    $joining_latter_ch = $employee->employeeOfficialDoc->joining_latter;
                } else {
                    $joining_latter_ch = 'Has No Joining Latter';
                }
                if ($empHis->is_active == 0) {
                    EmpHistory::create([
                        'job_id' => $job_id,
                        'call_id' => $joining_latter_status,
                        'is_active' => 1,
                        'remarks' => $joining_latter_ch,
                        'user_id' => auth()->user()->id,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                    ]);
                }
            }
        }

        $employee->update([
            "job_id" => $job_id,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "date_of_birth" => $date_of_birth,
            "gender" => $request->gender,
            "marital_status" => $request->marital_status,
            "father_name" => $request->father_name,
            "nationality" => $nationality,
            "n_identity_type" => $request->n_identity_type,
            "n_identity_no" => $request->n_identity_no,
            "current_address" => $request->current_address,
            "current_city" => $current_city,
            "current_state" => $current_state,
            "current_country" => $current_country,
            "permanent_address" => $request->permanent_address,
            "permanent_city" => $permanent_city,
            "permanent_state" => $permanent_state,
            "permanent_country" => $permanent_country,
            "mobile_number" => $request->mobile_number,
            "secondary_number" => $request->secondary_number,
            "skype_id" => $request->skype_id,
            "email" => $request->email,
            "bank_name" => $request->bank_name,
            "branch_name" => $request->branch_name,
            "account_name" => $request->account_name,
            "account_no" => $request->account_no,
            "department_id" => $request->department_id,
            "designation_id" => $request->designation_id,
            "location_id" => $request->location_id,
            "profile_image" => $profile_image,
            "joining_date" => $joining_date,
            'probation_due_on' => $probation_due_on,
            'remarks' => $request->remarks,
            'review_id' => $review_id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
            'user_id' => auth()->user()->id,
            "is_active" => $is_active,
        ]);

        if ($employee) {
            if (!empty($request->resume)) {
                EmployeePersonalDocument::create([
                    'path' => $resume,
                    'employee_id' => $employee->id,
                    'type' => 'resume'
                ]);
            }
            if (!empty($request->other_doc_personal)) {
                foreach ($request->other_doc_personal as $other_doc) {
                    $extension = $other_doc->getClientOriginalExtension();
                    $fileName = time() . "-." . $extension;
                    ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                    EmployeePersonalDocument::create([
                        'path' => '/project-assets/files/' . $fileName,
                        'employee_id' => $employee->id,
                        'type' => 'other_doc_personal'
                    ]);
                }
            }
            if (!empty($request->id_proof)) {
                foreach ($request->id_proof as $other_doc) {
                    $extension = $other_doc->getClientOriginalExtension();
                    $fileName = time() . "-." . $extension;
                    ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                    EmployeePersonalDocument::create([
                        'path' => '/project-assets/files/' . $fileName,
                        'employee_id' => $employee->id,
                        'type' => 'id_proof'
                    ]);
                }
            }
            if (!empty($request->official_latter)) {
                EmployeeOfficialDocument::create([
                    'path' => $official_latter,
                    'employee_id' => $employee->id,
                    'type' => 'official_latter'
                ]);

            }
            if (!empty($request->joining_latter)) {
                EmployeeOfficialDocument::create([
                    'path' => $joining_latter,
                    'employee_id' => $employee->id,
                    'type' => 'joining_latter'
                ]);
            }
            if (!empty($request->contract_paper)) {
                EmployeeOfficialDocument::create([
                    'path' => $contract_paper,
                    'employee_id' => $employee->id,
                    'type' => 'contract_paper'
                ]);
            }
            if (!empty($request->other_doc_official)) {
                foreach ($request->other_doc_official as $other_doc) {
                    $extension = $other_doc->getClientOriginalExtension();
                    $fileName = time() . "-." . $extension;
                    ImageHelpers::uploadFile('/project-assets/files/', $other_doc, $fileName);
                    EmployeeOfficialDocument::create([
                        'path' => '/project-assets/files/' . $fileName,
                        'employee_id' => $employee->id,
                        'type' => 'other_doc_official'
                    ]);
                }
            }
            $employee_histroy = EmployeeHistroy::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "date_of_birth" => $date_of_birth,
                "gender" => $request->gender,
                "marital_status" => $request->marital_status,
                "father_name" => $request->father_name,
                "nationality" => $nationality,
                "n_identity_type" => $request->n_identity_type,
                "n_identity_no" => $request->n_identity_no,
                "current_address" => $request->current_address,
                "current_city" => $current_city,
                "current_state" => $current_state,
                "current_country" => $current_country,
                "permanent_address" => $request->permanent_address,
                "permanent_city" => $permanent_city,
                "permanent_state" => $permanent_state,
                "permanent_country" => $permanent_country,
                "mobile_number" => $request->mobile_number,
                "secondary_number" => $request->secondary_number,
                "skype_id" => $request->skype_id,
                "email" => $request->email,
                "bank_name" => $request->bank_name,
                "branch_name" => $request->branch_name,
                "account_name" => $request->account_name,
                "account_no" => $request->account_no,
                "department_id" => $request->department_id,
                "designation_id" => $request->designation_id,
                "location_id" => $request->location_id,
                "profile_image" => $profile_image,
                "joining_date" => $joining_date,
                'created_at' => Carbon::now()->timezone(session('timezone')),
                "job_id" => $job_id,
                "employee_id" => $employee->id,
                'probation_due_on' => $probation_due_on,
                'remarks' => $request->remarks,
                'review_id' => $review_id,
                'user_id' => auth()->user()->id,
                "is_active" => 1,
            ]);
        }
    }

    public function allUpcomingReviews($request)
    {
        $allUpcomingReviews = Employee::with(['applicant.history' => function ($query) {
            $query->orderBy('dateTime', 'asc');
        }])->whereNull('deleted_at');
//dd($allUpcomingReviews);
        if ($request->search_title) {
            $title = $request->search_title;
            $allUpcomingReviews = $allUpcomingReviews->where('first_name', 'like', '%' . $title . '%')
                ->orWhere('last_name', 'like', '%' . $title . '%')
                ->orWhere('father_name', 'like', '%' . $title . '%')
                ->orWhere('email', 'like', '%' . $title . '%')
                ->orWhere('n_identity_no', 'like', '%' . $title . '%')
                ->orWhere('mobile_number', 'like', '%' . $title . '%')
                ->orWhere('secondary_number', 'like', '%' . $title . '%')
                ->orWhere('skype_id', 'like', '%' . $title . '%');

        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allUpcomingReviews = $allUpcomingReviews->whereBetween('created_at', [$start, $end]);

        }
        $data['allEmployees'] = $allUpcomingReviews->paginate($this->allEmployeesPagination);
        return $data;
    }

    public function allActiveInActiveEmployees($request)
    {
        $allEmployees = Employee::withoutGlobalScopes()->orderBy('id', 'desc');
//dd($allUpcomingReviews);
        if ($request->search_title) {
            $title = $request->search_title;
            $allEmployees = $allEmployees->where('first_name', 'like', '%' . $title . '%')
                ->orWhere('last_name', 'like', '%' . $title . '%')
                ->orWhere('father_name', 'like', '%' . $title . '%')
                ->orWhere('email', 'like', '%' . $title . '%')
                ->orWhere('n_identity_no', 'like', '%' . $title . '%')
                ->orWhere('mobile_number', 'like', '%' . $title . '%')
                ->orWhere('secondary_number', 'like', '%' . $title . '%')
                ->orWhere('skype_id', 'like', '%' . $title . '%');

        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allEmployees = $allEmployees->whereBetween('created_at', [$start, $end]);

        }
        $data['allEmployees'] = $allEmployees->paginate($this->allEmployeesPagination);
        return $data;
    }

    public function addStatusEmployee($request)
    {
//        dd($request->all());
        $employee = Employee::withoutGlobalScopes()->find($request->emp_id);
        if ($employee->is_active == 1) {
            $employee->is_active = 0;
            $employee->save();
        }
        if (!empty($request->date_of_birth)) {
            $date_of_birth = Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
        if ($empHis->is_active == 1) {
            $empHis->is_active = 0;
            $empHis->save();
        }
        if ($empHis->is_active == 0) {
            EmpHistory::create([
                'job_id' => $request->job_id,
                'call_id' => $request->status,
                'dateTime' => $date_of_birth,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }

    public function addStatusEmployeeReview($request, $employeeId)
    {
//        dd($request->all(), $employeeId);
//
        if (!empty($request->date_of_birth)) {
            $date_of_birth = Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }

        $employee = Employee::withoutGlobalScopes()->find($employeeId);

        if ($employee) {
            if ($request->remarks != null) {
                $remarks = $request->remarks;
            } else {
                $remarks = $employee->remarks;
            }
            $employee->probation_due_on = $date_of_birth;
            $employee->remarks = $remarks;
            $employee->save();
        }
        $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
        if ($empHis->is_active == 1) {
            $empHis->is_active = 0;
            $empHis->save();
        }
        if ($empHis->is_active == 0) {
            EmpHistory::create([
                'job_id' => $request->job_id,
                'call_id' => $request->status,
                'dateTime' => $date_of_birth,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }

    public function nextReviewEmployee($request)
    {
//        dd($request->all());
        if (!empty($request->date_of_birth)) {
            $date_of_birth = Carbon::parse(str_replace('-', '', $request->date_of_birth))->format('Y-m-d');
        } else {
            $date_of_birth = null;
        }
        $empHis = EmpHistory::where([['job_id', '=', $request->job_id], ['is_active', '=', 1]])->first();
        if ($empHis->is_active == 1) {
            $empHis->is_active = 0;
            $empHis->save();
        }
        if ($empHis->is_active == 0) {
            EmpHistory::create([
                'job_id' => $request->job_id,
                'call_id' => $request->status,
                'dateTime' => $date_of_birth,
                'is_active' => 1,
                'remarks' => $request->remarks,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }


    public function createUsers()
    {

    }

}