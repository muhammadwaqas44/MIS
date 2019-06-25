<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Schedule;
use App\Services\ScheduleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function allSchedules(Request $request, ScheduleServices $scheduleServices)
    {
        $data['allSchedules'] = $scheduleServices->allSchedules($request);
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->whereNull('parent_id')->get();
        $data['updatedSchedules'] = Schedule::withoutGlobalScopes()->where('is_active', '=', 0)->get();
//dd($data['updatedSchedules']);
        return view('admin.schedule.all-schedule', compact('data'));
    }

    public function interviewSchedulePost(Request $request, ScheduleServices $scheduleServices)
    {
        $scheduleServices->interviewSchedulePost($request);
        return redirect()->back();
    }

    public function changeScheduleStatus($scheduleId, ScheduleServices $scheduleServices)
    {
        $scheduleServices->changeScheduleStatus($scheduleId);
        return redirect()->back();
    }

    public function deleteSchedule($scheduleId)
    {
        $schedule = Schedule::where('id', $scheduleId)->firstOrFail();
        $schedule->delete();
        return redirect()->back();
    }

    public function editScheduleData($scheduleId)
    {
        $schedule = Schedule::where('id', $scheduleId)->firstOrFail();

        return response()->json($schedule);
    }

    public function interviewScheduleUpdate(Request $request, $scheduleId, ScheduleServices $scheduleServices)
    {
        $scheduleServices->interviewScheduleUpdate($request, $scheduleId);
        return redirect()->back();
    }

}
