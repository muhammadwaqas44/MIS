<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/18/2019
 * Time: 2:26 PM
 */

namespace App\Services;


use App\EmpHistory;
use App\Helpers\ImageHelpers;
use App\JobApplication;
use Carbon\Carbon;
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
            $query->where('module', '=', 'Call Status')->where('id', '!=', 3);
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
            if ($request->call_id1 != null) {
                if ($request->dateTime == null) {
                    EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                        'call_id' => $request->call_id1, 'user_id' => auth()->user()->id]));

                } else {
                    $scheduleData = EmpHistory::create(array_merge($request->except('_token'), [
                        'is_active' => 1,
                        'call_id' => $request->call_id1,
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
                            $subject = "Interview Invitation";
                            $txt = '<div class="h2">
                        Dear <b>$name</b>,
                    <br>
                    <br>
                        Thank you for applying at <b>Tech Nerds (The Next Idea)</b>.
                        <br>
                        <br>
                        We received your application for the post of <b>$designation</b>.
                    <br>
                    <br>
                        You have been shortlisted for an interview on <b>$date</b>.
                    <br>
                    <br>
                        Address: <b>140 F1, Johar Town, Lahore. opposite LDA Offices and Behind Lahore Grammar School</b>.
                    <br>
                    <br>
                     <a href="https://www.google.com/maps/place/The+Next+Idea/@31.4611365,74.279492,17z/data=!3m1!4b1!4m5!3m4!1s0x391901552fd5b9c5:0xad054825edd07a70!8m2!3d31.4611365!4d74.2816807">Click Here </a>to get our Google Map Location.
                    <br>
                    <br>
                        Regards,
                            <br>
                        Tech Nerds
                            <br>
                        https://technerds.com/<br>
                        +92-42-35315372
                </div>';
                            $message = str_replace('$name', $name, $txt);
                            $message = str_replace('$date', $date, $message);

                            $message = str_replace('$designation', $designation, $message);
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From:" . "kash@technerds.com" . "\r\n" .
                                "CC: ishteeaq@gmail.com";

                            if (mail($to, $subject, $message, $headers)) {
                                return response()->json(['result' => 'success', 'message' => 'Email Send to Applicant!'], 200);
                            } else {
                                return response()->json(['result' => 'error', 'message' => 'Error in sending email!'], 200);
                            }
                        } else {
                            return redirect()->back();
                        }
                    }
                }
            } else {
                if ($request->dateTime == null) {
                    EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                        'call_id' => $request->call_id2, 'user_id' => auth()->user()->id]));

                } else {
                    $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'call_id' => $request->call_id2,
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
                            dd($designation);
                            $name = $applicant->name;
                            $date = Carbon::parse($scheduleData->dateTime)->format("l d F Y  h:i A");
                            $to = $applicant->email;
                            $subject = "Interview Invitation";
                            $txt = '<div class="h2">
                        Dear <b>$name</b>,
                    <br>
                    <br>
                        Thank you for applying at <b>Tech Nerds (The Next Idea)</b>.
                        <br>
                        <br>
                        We received your application for the post of <b>$designation</b>.
                    <br>
                    <br>
                        You have been shortlisted for an interview on <b>$date</b>.
                    <br>
                    <br>
                        Address: <b>140 F1, Johar Town, Lahore. opposite LDA Offices and Behind Lahore Grammar School</b>.
                    <br>
                    <br>
                     <a href="https://www.google.com/maps/place/The+Next+Idea/@31.4611365,74.279492,17z/data=!3m1!4b1!4m5!3m4!1s0x391901552fd5b9c5:0xad054825edd07a70!8m2!3d31.4611365!4d74.2816807">Click Here </a>to get our Google Map Location.
                    <br>
                    <br>
                        Regards,
                            <br>
                        Tech Nerds
                            <br>
                        https://technerds.com/<br>
                        +92-42-35315372
                </div>';
                            $message = str_replace('$name', $name, $txt);
                            $message = str_replace('$date', $date, $message);
                            $message = str_replace('$designation', $designation, $message);
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From:" . "kash@technerds.com" . "\r\n" .
                                "CC: ishteeaq@gmail.com";

                            if (mail($to, $subject, $message, $headers)) {
                                return response()->json(['result' => 'success', 'message' => 'Email Send to Applicant!'], 200);
                            } else {
                                return response()->json(['result' => 'error', 'message' => 'Error in sending email!'], 200);
                            }
                        } else {
                            return redirect()->back();
                        }
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

        $schedule = EmpHistory::find($scheduleId);
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0) {
            if ($request->call_id1 != null) {
                if ($request->dateTime == null) {
                    EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'call_id' => $request->call_id1, 'user_id' => auth()->user()->id]));

                } else {
                    $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'call_id' => $request->call_id1,
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
                            $subject = "Interview Invitation";
                            $txt = '<div class="h2">
                        Dear <b>$name</b>,
                    <br>
                    <br>
                        Thank you for applying at <b>Tech Nerds (The Next Idea)</b>.
                        <br>
                        <br>
                        We received your application for the post of <b>$designation</b>.
                    <br>
                    <br>
                        You have been shortlisted for an interview on <b>$date</b>.
                    <br>
                    <br>
                        Address: <b>140 F1, Johar Town, Lahore. opposite LDA Offices and Behind Lahore Grammar School</b>.
                    <br>
                    <br>
                     <a href="https://www.google.com/maps/place/The+Next+Idea/@31.4611365,74.279492,17z/data=!3m1!4b1!4m5!3m4!1s0x391901552fd5b9c5:0xad054825edd07a70!8m2!3d31.4611365!4d74.2816807">Click Here </a>to get our Google Map Location.
                    <br>
                    <br>
                        Regards,
                            <br>
                        Tech Nerds
                            <br>
                        https://technerds.com/<br>
                        +92-42-35315372
                </div>';
                            $message = str_replace('$name', $name, $txt);
                            $message = str_replace('$date', $date, $message);
                            $message = str_replace('$designation', $designation, $message);
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From:" . "kash@technerds.com" . "\r\n" .
                                "CC: ishteeaq@gmail.com";

                            if (mail($to, $subject, $message, $headers)) {
                                return response()->json(['result' => 'success', 'message' => 'Email Send to Applicant!'], 200);
                            } else {
                                return response()->json(['result' => 'error', 'message' => 'Error in sending email!'], 200);
                            }
                        } else {
                            return redirect()->back();
                        }
                    }
                }
            } else {
                if ($request->dateTime == null) {
                    EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                        'created_at' => Carbon::now()->timezone(session('timezone')),
                        'call_id' => $request->call_id2, 'user_id' => auth()->user()->id]));
                } else {
                    $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'call_id' => $request->call_id2,
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
                            $subject = "Interview Invitation";
                            $txt = '<div class="h2">
                        Dear <b>$name</b>,
                    <br>
                    <br>
                        Thank you for applying at <b>Tech Nerds (The Next Idea)</b>.
                        <br>
                        <br>
                        We received your application for the post of <b>$designation</b>p.
                    <br>
                    <br>
                        You have been shortlisted for an interview on <b>$date</b>.
                    <br>
                    <br>
                        Address: <b>140 F1, Johar Town, Lahore. opposite LDA Offices and Behind Lahore Grammar School</b>.
                    <br>
                    <br>
                     <a href="https://www.google.com/maps/place/The+Next+Idea/@31.4611365,74.279492,17z/data=!3m1!4b1!4m5!3m4!1s0x391901552fd5b9c5:0xad054825edd07a70!8m2!3d31.4611365!4d74.2816807">Click Here </a>to get our Google Map Location.
                    <br>
                    <br>
                        Regards,
                            <br>
                        Tech Nerds
                            <br>
                        https://technerds.com/<br>
                        +92-42-35315372
                </div>';
                            $message = str_replace('$name', $name, $txt);
                            $message = str_replace('$date', $date, $message);
                            $message = str_replace('$designation', $designation, $message);
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From:" . "kash@technerds.com" . "\r\n" .
                                "CC: ishteeaq@gmail.com";

                            if (mail($to, $subject, $message, $headers)) {
                                return response()->json(['result' => 'success', 'message' => 'Email Send to Applicant!'], 200);
                            } else {
                                return response()->json(['result' => 'error', 'message' => 'Error in sending email!'], 200);
                            }
                        } else {
                            return redirect()->back();
                        }
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
        if ($request->call_id == 14) {
            if (empty($request->file_attach)) {
                return 'Please Attach Offer Given Latter..';
            }
        }
//        dd($request);
        $schedule = EmpHistory::find($scheduleId);
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0) {
            if ($request->dateTime == null) {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
                if ($request->file_attach) {
                    if ($request->emailSend == 1) {
                        if ($scheduleData->call_id == 14) {
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
                            Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $request) {
                                $message->to($to, $name)->subject('Job Offer Letter');
                                $message->attach($request->file('file_attach')->getRealPath(), [
                                    'as' => $request->file('file_attach')->getClientOriginalName(),
                                    'mime' => $request->file('file_attach')->getMimeType()]);
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
                if ($request->file_attach) {
                    if ($request->emailSend == 1) {
                        if ($scheduleData->call_id == 14) {
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
                            Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $request) {
                                $message->to($to, $name)->subject('Job Offer Letter');
                                $message->attach($request->file('file_attach')->getRealPath(), [
                                    'as' => $request->file('file_attach')->getClientOriginalName(),
                                    'mime' => $request->file('file_attach')->getMimeType()]);
                                $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                            });
                            return response()->json(['message' => 'Request completed']);

                        } else {
                            return redirect()->back();
                        }
                    }
                }
            }

        } else {
            return redirect()->back();
        }
    }

    public function interviewDataUpdate($request, $interviewId)
    {
        if ($request->call_id == 14) {
            if (empty($request->file_attach)) {
                return 'Please Attach Offer Given Latter..';
            }
        }
        $schedule = EmpHistory::find($interviewId);
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0) {
            if ($request->dateTime == null) {
                $scheduleData = EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1,
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()->timezone(session('timezone')),
                ]));
                if ($request->file_attach) {
                    if ($request->emailSend == 1) {
                        if ($scheduleData->call_id == 14) {
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
                            Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $request) {
                                $message->to('vickyrana4433@gmail.com', $name)->subject('Job Offer Letter');
                                $message->attach($request->file('file_attach')->getRealPath(), [
                                    'as' => $request->file('file_attach')->getClientOriginalName(),
                                    'mime' => $request->file('file_attach')->getMimeType()]);
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
                if ($request->file_attach) {
                    if ($request->emailSend == 1) {
                        if ($scheduleData->call_id == 14) {
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
                            Mail::send('mail.offer-mail', $data, function ($message) use ($to, $name, $request) {
                                $message->to('vickyrana4433@gmail.com', $name)->subject('Job Offer Letter');
                                $message->attach($request->file('file_attach')->getRealPath(), [
                                    'as' => $request->file('file_attach')->getClientOriginalName(),
                                    'mime' => $request->file('file_attach')->getMimeType()]);
                                $message->cc('ishteeaq@gmail.com', 'Ishtiaq Haider');
                            });
                            return response()->json(['message' => 'Request completed']);
                        } else {
                            return redirect()->back();
                        }
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
                    ->orWhere('email', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%')
                    ->orWhere('city_name', 'like', '%' . $title . '%')
                    ->orWhere('address', 'like', '%' . $title . '%');
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
