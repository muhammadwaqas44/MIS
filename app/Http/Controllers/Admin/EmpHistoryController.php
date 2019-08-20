<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Designation;
use App\EmpHistory;
use App\Exports\JobApplicantExport;
use App\JobApplication;
use App\Services\EmpHistoryServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EmpHistoryController extends Controller
{
    public function allSchedules(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allSchedules'] = $empHistoryServices->allSchedules($request);
        $data['callStatus'] = CallStatus::where('module', '=', 'Call Status')->get();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Form Fill Status')->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.all-schedule', compact('data'));
    }

    public function allSchedulesNOtAvailable(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allSchedules'] = $empHistoryServices->allSchedulesNOtAvailable($request);
        $data['callStatus'] = CallStatus::where('module', '=', 'Call Status')->get();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Form Fill Status')->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.all-schedule-extra', compact('data'));
    }

    public function interviewSchedulePost(Request $request, EmpHistoryServices $empHistoryServices)
    {
//        dd($request->all());
        $jobApplication = JobApplication::find($request->job_id);
        if ($jobApplication->designation_id == 1) {
            return "Please Update Applicant's Position";
        } else {
            $empHistoryServices->interviewSchedulePost($request);
            return redirect()->route('admin.all-job-application');
        }
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

    public function viewStatusInterview($scheduleId)
    {
        $schedule = EmpHistory::find($scheduleId);
        $data['callStatus'] = CallStatus::where('module', '=', 'Call Status')->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.edit-schedule-interview', compact('data', 'schedule'));
    }

    public function viewStatusNotInterview($scheduleId)
    {
        $schedule = EmpHistory::find($scheduleId);
        $data['callStatus'] = CallStatus::where('module', '=', 'Call Status')->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.edit-schedule-not-interview', compact('data', 'schedule'));
    }

    public function interviewScheduleUpdate(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewScheduleUpdate($request, $scheduleId);
        return redirect()->route('admin.all-schedules');
    }

    public function interviewScheduleUpdateAll(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewScheduleUpdate($request, $scheduleId);
        return redirect()->route('admin.all-applicants');
    }

    public function interviewNotScheduleUpdate(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewScheduleUpdate($request, $scheduleId);
        return redirect()->route('admin.all-schedules-not-available');
    }

    public function interviewDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->back();
    }

    public function allInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allInterviews'] = $empHistoryServices->allInterviews($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Form Fill Status')->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.initial-interview.all-interviews', compact('data'));
    }

    public function interviewDataUpdate(Request $request, $interviewId, EmpHistoryServices $empHistoryServices)
    {
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataUpdate($request, $interviewId);
        return redirect()->back();
    }

    public function allShortlisted(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allShortlisted'] = $empHistoryServices->allShortlisted($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('short_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.shortlisted.shortlisted', compact('data'));
    }

    public function allTechInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allTechInterviews'] = $empHistoryServices->allTechInterviews($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('tech_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.technical-interview.tech-interview', compact('data'));
    }

    public function allHRInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allHRInterviews'] = $empHistoryServices->allHRInterviews($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.hr-interview.hr-interview', compact('data'));
    }

    public function allOfferGiven(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allOfferGiven'] = $empHistoryServices->allOfferGiven($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.offer-given.offer-given', compact('data'));
    }

    public function allApplicants(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allApplicants'] = $empHistoryServices->allApplicants($request);
        $data['callStatus'] = CallStatus::where('module', '!=', 'Update Employee')->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        $data['designation'] = Designation::where('id', '!=', 1)->get();
        $data['statuses'] = CallStatus::all();
        return view('admin..hiring.all-applicants.all-applicants', compact('data'));
    }

    public function exportJobApplicant()
    {
        return Excel::download(new JobApplicantExport(), 'Job-Applicants.xlsx');
    }
}
