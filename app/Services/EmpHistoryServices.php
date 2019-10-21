<?php
/**
 * Created by PhpStorm.
 * Date: 6/18/2019
 * Time: 2:26 PM
 */

namespace App\Services;


use App\EmpHistory;
use App\Helpers\ImageHelpers;
use App\JobApplication;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mail;

class EmpHistoryServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 20;
    }

    public function allSchedules($request)
    {
        $allSchedules = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('id', '=', 3);
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allSchedules = $allSchedules->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allSchedules = $allSchedules->whereBetween('dateTime', [$start, $end]);

        }
        $data['allSchedules'] = $allSchedules->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function allSchedulesNOtAvailable($request)
    {
        $allSchedules = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('parent_id', 2);
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allSchedules = $allSchedules->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allSchedules = $allSchedules->whereBetween('dateTime', [$start, $end]);

        }
        $data['allSchedules'] = $allSchedules->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function interviewSchedulePost($request)
    {
//        dd($request);
        $jobApplication = JobApplication::find($request->job_id);
        $schedule = EmpHistory::find($request->his_id);
        if ($jobApplication->is_active == 1) {
            $jobApplication->is_active = 0;
            $jobApplication->save();
        }
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($jobApplication->is_active == 0 && $schedule->is_active == 0) {

            if ($request->dateTime == null) {
                EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                    'call_id' => $request->call_id, 'user_id' => auth()->user()->id]));

            } else {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), [
                    'is_active' => 1,
                    'call_id' => $request->call_id,
                    'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))->format('Y-m-d H:i:s'),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),]));

                if ($request->emailSend == 1) {
                    if ($scheduleData->call_id == 3) {
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        if ($applicant->designation->id == 1) {
                            $designation = $applicant->apply_for;
                        } else {
                            $designation = $applicant->designation->name;
                        }
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("l d F Y  h:i A");
                        $to = $applicant->email;

                        $data = array('name' => $name,
                            'designation' => $designation,
                            'date' => $date,
                        );
                        Mail::send('mail.interview-schedule', $data, function ($message) use ($to, $name) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject
                            ('Interview Invitation');
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
                    } else {
                        return redirect()->back();
                    }
                }
            }

        }

    }

    public function changeScheduleStatus($scheduleId)
    {
        $schedule = EmpHistory::find($scheduleId);
        if ($schedule->is_active == 0) {
            $schedule->is_active = 1;
            $schedule->save();
        } else {
            $schedule->is_active = 0;
            $schedule->save();
        }
    }

    public function interviewScheduleUpdate($request, $scheduleId)
    {
//        dd($request->all());


        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($jobApplication->is_active == 1) {
            $jobApplication->is_active = 0;
            $jobApplication->save();
        }
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0 && $jobApplication->is_active == 0) {

            if ($request->dateTime == null) {
                EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'call_id' => $request->call_id, 'user_id' => auth()->user()->id]));

            } else {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'call_id' => $request->call_id,
                    'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))->format('Y-m-d H:i:s'),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
                if ($request->emailSend == 1) {
                    if ($scheduleData->call_id == 3) {
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        if ($applicant->designation->id == 1) {
                            $designation = $applicant->apply_for;
                        } else {
                            $designation = $applicant->designation->name;
                        }
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("l d F Y  h:i A");
                        $to = $applicant->email;

                        $data = array('name' => $name,
                            'designation' => $designation,
                            'date' => $date,
                        );
                        Mail::send('mail.interview-schedule', $data, function ($message) use ($to, $name) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject
                            ('Interview Invitation');
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');

                        });
                    } else {
                        return redirect()->back();
                    }
                }
            }

        }

    }

    public function allInterviews($request)
    {
        $allInterviews = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('module', '=', 'Form Fill Status');
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allInterviews = $allInterviews->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allInterviews = $allInterviews->whereBetween('dateTime', [$start, $end]);

        }
        $data['allInterviews'] = $allInterviews->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function interviewDataPost($request, $scheduleId)
    {
//        dd($request->all(), $scheduleId);
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($jobApplication->is_active == 1) {
            $jobApplication->is_active = 0;
            $jobApplication->save();
        }
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0 && $jobApplication->is_active == 0) {
            if ($request->dateTime == null) {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
//                if ($request->file_attach) {
                if ($request->emailSend == 1) {
                    if (!empty($request->file_attach)) {
                        if ($jobApplication) {
                            $extension = $request->file_attach->getClientOriginalExtension();
                            $fileName = time() . "-" . 'file_attach.' . $extension;
                            ImageHelpers::uploadFile('/offer-latter/', $request->file('file_attach'), $fileName);
                            $path = '/offer-latter/' . $fileName;
                            $jobApplication->joining_latter = $path;
                            $jobApplication->save();
                        }
                    }
                    if ($scheduleData->call_id == 14) {
                        $joining_latter = public_path($jobApplication->joining_latter);
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        $designation = $applicant->designation->name;
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("d F Y");
                        $to = $applicant->email;
                        $data = array('name' => $name,
                            'date' => $date,
                            'designation' => $designation,
                        );
                        Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $joining_latter, $request) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject('Job Offer Letter');
                            $message->attach($joining_latter);
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
//                        return response()->json(['message' => 'Request completed']);

                    } elseif ($scheduleData->call_id == 3) {
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        if ($applicant->designation->id == 1) {
                            $designation = $applicant->apply_for;
                        } else {
                            $designation = $applicant->designation->name;
                        }
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("l d F Y  h:i A");
                        $to = $applicant->email;

                        $data = array('name' => $name,
                            'designation' => $designation,
                            'date' => $date,
                        );
                        Mail::send('mail.interview-schedule', $data, function ($message) use ($to, $name) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject
                            ('Interview Invitation');
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
                    }
                }
//                }
            } else {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))->format('Y-m-d H:i:s'),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
//                if ($request->file_attach) {
                if ($request->emailSend == 1) {
                    if (!empty($request->file_attach)) {
                        if ($jobApplication) {
                            $extension = $request->file_attach->getClientOriginalExtension();
                            $fileName = time() . "-" . 'file_attach.' . $extension;
                            ImageHelpers::uploadFile('/offer-latter/', $request->file('file_attach'), $fileName);
                            $path = '/offer-latter/' . $fileName;
                            $jobApplication->joining_latter = $path;
                            $jobApplication->save();
                        }
                    }
                    if ($scheduleData->call_id == 14) {
                        $joining_latter = public_path($jobApplication->joining_latter);
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        $designation = $applicant->designation->name;
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("d F Y");
                        $to = $applicant->email;
                        $data = array('name' => $name,
                            'date' => $date,
                            'designation' => $designation,
                        );
                        $mail = Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $joining_latter, $request) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject('Job Offer Letter');
                            $message->attach($joining_latter);
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
                    } elseif ($scheduleData->call_id == 3) {
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        if ($applicant->designation->id == 1) {
                            $designation = $applicant->apply_for;
                        } else {
                            $designation = $applicant->designation->name;
                        }
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("l d F Y  h:i A");
                        $to = $applicant->email;

                        $data = array('name' => $name,
                            'designation' => $designation,
                            'date' => $date,
                        );
                        Mail::send('mail.interview-schedule', $data, function ($message) use ($to, $name) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject
                            ('Interview Invitation');
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
                    }
                }
//                }
            }

        } else {
            return redirect()->back();
        }
    }

    public function interviewDataUpdate($request, $interviewId)
    {
        dd($request->all(), $interviewId);
        $schedule = EmpHistory::find($interviewId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($jobApplication->is_active == 1) {
            $jobApplication->is_active = 0;
            $jobApplication->save();
        }
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0 && $jobApplication->is_active == 0) {
            if ($request->dateTime == null) {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
                if ($request->file_attach) {
                    if ($request->emailSend == 1) {
                        if (!empty($request->file_attach)) {
                            if ($jobApplication) {
                                $extension = $request->file_attach->getClientOriginalExtension();
                                $fileName = time() . "-" . 'file_attach.' . $extension;
                                ImageHelpers::uploadFile('/offer-latter/', $request->file('file_attach'), $fileName);
                                $path = '/offer-latter/' . $fileName;
                                $jobApplication->joining_latter = $path;
                                $jobApplication->save();
                            }
                        }
                        if ($scheduleData->call_id == 14) {
                            $joining_latter = public_path($jobApplication->joining_latter);
                            $applicant = JobApplication::find($scheduleData->job_id);
                            $scheduleData = EmpHistory::find($scheduleData->id);
                            $designation = $applicant->designation->name;
                            $name = $applicant->name;
                            $date = Carbon::parse($scheduleData->dateTime)->format("d F Y");
                            $to = $applicant->email;
                            $data = array('name' => $name,
                                'date' => $date,
                                'designation' => $designation,
                            );
                            Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $joining_latter, $request) {
                                $message->from('hr@technerds.com', 'Tech Nerds');
                                $message->to($to, $name)->subject('Job Offer Letter');
                                $message->attach($joining_latter);
                                $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                            });
                            return response()->json(['message' => 'Request completed']);

                        } else {
                            return redirect()->back();
                        }
                    }
                }
            } else {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))->format('Y-m-d H:i:s'),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));

                if ($request->emailSend == 1) {
                    if (!empty($request->file_attach)) {
                        if ($jobApplication) {
                            $extension = $request->file_attach->getClientOriginalExtension();
                            $fileName = time() . "-" . 'file_attach.' . $extension;
                            ImageHelpers::uploadFile('/offer-latter/', $request->file('file_attach'), $fileName);
                            $path = '/offer-latter/' . $fileName;
                            $jobApplication->joining_latter = $path;
                            $jobApplication->save();
                        }
                    }
                    if ($scheduleData->call_id == 14) {
                        $joining_latter = public_path($jobApplication->joining_latter);
                        $applicant = JobApplication::find($scheduleData->job_id);
                        $scheduleData = EmpHistory::find($scheduleData->id);
                        $designation = $applicant->designation->name;
                        $name = $applicant->name;
                        $date = Carbon::parse($scheduleData->dateTime)->format("d F Y");
                        $to = $applicant->email;
                        $data = array('name' => $name,
                            'date' => $date,
                            'designation' => $designation,
                        );
                        Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $joining_latter, $request) {
                            $message->from('hr@technerds.com', 'Tech Nerds');
                            $message->to($to, $name)->subject('Job Offer Letter');
                            $message->attach($joining_latter);
                            $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                        });
                        return response()->json(['message' => 'Request completed']);
                    } else {
                        return redirect()->back();
                    }
                }
            }

        } else {
            return redirect()->back();
        }
    }

    public function allShortlisted($request)
    {
        $allShortlisted = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'Shortlisted');
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allShortlisted = $allShortlisted->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allShortlisted = $allShortlisted->whereBetween('dateTime', [$start, $end]);

        }
        $data['allShortlisted'] = $allShortlisted->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function allTechInterviews($request)
    {
        $allTechInterviews = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'Technical Interview Required');
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allTechInterviews = $allTechInterviews->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allTechInterviews = $allTechInterviews->whereBetween('dateTime', [$start, $end]);

        }
        $data['allTechInterviews'] = $allTechInterviews->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function allHRInterviews($request)
    {
        $allHRInterviews = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'HR Interview Required');
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allHRInterviews = $allHRInterviews->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allHRInterviews = $allHRInterviews->whereBetween('dateTime', [$start, $end]);

        }
        $data['allHRInterviews'] = $allHRInterviews->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function allOfferGiven($request)
    {
        $allOfferGiven = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'Offer Given');
        })->orderBy('dateTime', 'asc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allOfferGiven = $allOfferGiven->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
            });
        }

        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allOfferGiven = $allOfferGiven->whereBetween('dateTime', [$start, $end]);

        }
        $data['allOfferGiven'] = $allOfferGiven->paginate($this->allSchedulesPagination);

        return $data;
    }

    public function allApplicants($request)
    {
        $allApplicants = EmpHistory::orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

        if ($request->search_title) {
            $title = $request->search_title;
            $allApplicants = $allApplicants->with(['applicant'])->whereHas('applicant', function ($query) use ($title) {
                $query->where('name', 'like', '%' . $title . '%')
                    ->orWhere('id', 'like', '%' . $title . '%')
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
//                    ->orWhere('city_name', 'like', '%' . $title . '%')
//                    ->orWhere('address', 'like', '%' . $title . '%');
            });
        }
        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allApplicants = $allApplicants->whereBetween('created_at', [$start, $end]);

        }
        if ($request->designation_id) {
            $designation = $request->designation_id;
            $allApplicants = $allApplicants->with(['applicant'])->whereHas('applicant', function ($query) use ($designation) {
                $query->where('designation_id', '=', $designation);;
            });
        }
        if ($request->status_id) {
            $allApplicants = $allApplicants->where('call_id', '=', $request->status_id);
        }
        $data['allApplicants'] = $allApplicants->paginate($this->allSchedulesPagination);

        return $data;
    }

}
