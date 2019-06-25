<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/18/2019
 * Time: 2:26 PM
 */

namespace App\Services;


use App\JobApplication;
use App\Schedule;
use Carbon\Carbon;

class ScheduleServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 12;
    }

    public function allSchedules($request)
    {
        $allSchedules = Schedule::orderBy('id', 'desc')->whereNull('deleted_at');

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
        Schedule::create(array_merge($request->except('_token'), ['is_active' => 1, 'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))]));
    }

    public function changeScheduleStatus($scheduleId)
    {
        $schedule = Schedule::withoutGlobalScopes()->find($scheduleId);
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
        $schedule = Schedule::withoutGlobalScopes()->find($scheduleId);
        if ($schedule->is_active == 1) {
            $schedule->is_active = 0;
            $schedule->save();
        }
        if ($schedule->is_active == 0) {
            Schedule::create(array_merge($request->except('_token'), ['is_active' => 1, 'dateTime' => Carbon::parse(str_replace('-', '', $request->dateTime))]));
        }else{
            return redirect()->back();
        }
    }
}