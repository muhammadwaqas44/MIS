<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\EmpHistory;
use App\JobApplication;
use App\Services\EmpHistoryServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpHistoryController extends Controller
{
    public function allSchedules(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allSchedules'] = $empHistoryServices->allSchedules($request);
        $data['jobApp'] =JobApplication::all();
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Call Status')->get();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Form Fill Status')->get();
        $data['updatedSchedules'] = EmpHistory::where('is_active', '=', 0)->get();
        return view('admin.employment.schedule.all-schedule', compact('data'));
    }

    public function interviewSchedulePost(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewSchedulePost($request);
        return redirect()->back();
    }

    public function changeScheduleStatus($scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->changeScheduleStatus($scheduleId);
        return redirect()->back();
    }

    public function deleteSchedule($scheduleId)
    {
        $schedule = EmpHistory::where('id', $scheduleId)->firstOrFail();
        $schedule->delete();
        return redirect()->back();
    }

    public function editScheduleData($scheduleId)
    {
        $schedule = EmpHistory::where('id', $scheduleId)->firstOrFail();

        return response()->json($schedule);
    }

    public function interviewScheduleUpdate(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewScheduleUpdate($request, $scheduleId);
        return redirect()->back();
    }

    public function interviewDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->back();
    }

    public function allInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allInterviews'] = $empHistoryServices->allInterviews($request);
        $data['jobApp'] =JobApplication::all();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Form Fill Status')->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::where('is_active', '=', 0)->get();
        return view('admin..employment.initial-interview.all-interviews', compact('data'));
    }

    public function interviewDataUpdate(Request $request, $interviewId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewDataUpdate($request, $interviewId);
        return redirect()->back();
    }

    public function allShortlisted(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allShortlisted'] = $empHistoryServices->allShortlisted($request);
        $data['jobApp'] =JobApplication::all();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('short_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::where('is_active', '=', 0)->get();
        return view('admin..employment.shortlisted.shortlisted', compact('data'));
    }

    public function allTechInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allTechInterviews'] = $empHistoryServices->allTechInterviews($request);
        $data['jobApp'] =JobApplication::all();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('tech_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::where('is_active', '=', 0)->get();
        return view('admin..employment.technical-interview.tech-interview', compact('data'));
    }

    public function allHRInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allHRInterviews'] = $empHistoryServices->allHRInterviews($request);
        $data['jobApp'] =JobApplication::all();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::where('is_active', '=', 0)->get();
        return view('admin..employment.hr-interview.hr-interview', compact('data'));
    }
    public function allOfferGiven(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allOfferGiven'] = $empHistoryServices->allOfferGiven($request);
        $data['jobApp'] =JobApplication::all();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::where('is_active', '=', 0)->get();
        return view('admin..employment.offer-given.offer-given', compact('data'));
    }

}
