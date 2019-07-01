<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/18/2019
 * Time: 2:26 PM
 */

namespace App\Services;


use App\EmpHistory;
use App\JobApplication;
use Carbon\Carbon;

class EmpHistoryServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 20;
    }

    public function allSchedules($request)
    {
        $allSchedules = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('module', '=', 'Call Status');
        })->orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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
        $jobApplication = JobApplication::find($request->job_id);
        if ($jobApplication->is_active == 1) {
            $jobApplication->is_active = 0;
            $jobApplication->save();
        }
        if ($jobApplication->is_active == 0) {
            EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))]));
        } else {
            return redirect()->back();
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
            EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))]));
        } else {
            return redirect()->back();
        }
    }

    public function allInterviews($request)
    {
        $allInterviews = EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('module', '=', 'Form Fill Status');
        })->orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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

    public function interviewDataPost($request,$scheduleId)
    {
        $schedule = EmpHistory::find($scheduleId);
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0) {
            EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))]));
        } else {
            return redirect()->back();
        }
    }

    public function interviewDataUpdate($request, $interviewId)
    {
        $schedule = EmpHistory::find($interviewId);
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0) {
            EmpHistory::create(array_merge($request->except('_token'), ['is_active' => 1, 'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))]));
        } else {
            return redirect()->back();
        }
    }

    public function allShortlisted($request)
    {
        $allShortlisted= EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'Shortlisted');
        })->orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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
        $allTechInterviews= EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'Technical Interview Required');
        })->orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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
        $allHRInterviews= EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'HR Interview Required');
        })->orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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
        $allOfferGiven= EmpHistory::with(['status'])->whereHas('status', function ($query) {
            $query->where('name', '=', 'Offer Given');
        })->orderBy('id', 'desc')->where('is_active', 1)->whereNull('deleted_at');

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

}