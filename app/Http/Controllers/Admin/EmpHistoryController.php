<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
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
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Call Status')->get();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Form Fill Status')->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.all-schedule', compact('data'));
    }

    public function allSchedulesNOtAvailable(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allSchedules'] = $empHistoryServices->allSchedulesNOtAvailable($request);
        $data['callStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Call Status')->get();
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Form Fill Status')->get();
        $data['updatedSchedules'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.all-schedule-extra', compact('data'));
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
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Form Fill Status')->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.initial-interview.all-interviews', compact('data'));
    }

    public function interviewDataUpdate(Request $request, $interviewId, EmpHistoryServices $empHistoryServices)
    {
        $empHistoryServices->interviewDataUpdate($request, $interviewId);
        return redirect()->back();
    }

    public function allShortlisted(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allShortlisted'] = $empHistoryServices->allShortlisted($request);
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('short_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.shortlisted.shortlisted', compact('data'));
    }

    public function allTechInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allTechInterviews'] = $empHistoryServices->allTechInterviews($request);
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('tech_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.technical-interview.tech-interview', compact('data'));
    }

    public function allHRInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allHRInterviews'] = $empHistoryServices->allHRInterviews($request);
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.hr-interview.hr-interview', compact('data'));
    }

    public function allOfferGiven(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allOfferGiven'] = $empHistoryServices->allOfferGiven($request);
        $data['interviewStatus'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::withoutGlobalScopes()->where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.offer-given.offer-given', compact('data'));
    }
    public function allApplicants(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allApplicants'] = $empHistoryServices->allApplicants($request);
        $data['callStatus'] = CallStatus::all();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.all-applicants.all-applicants', compact('data'));
    }
    public function exportJobApplicant()
    {
        return Excel::download(new JobApplicantExport(), 'Job-Applicants.xlsx');
    }
//    public function mailSchedule($applicantId, $scheduleId)
//    {
//        $applicant = JobApplication::find($applicantId);
//        $schedule = EmpHistory::find($scheduleId);
//        $name = $applicant->name;
//        $date = $schedule->dateTime;
//        $to = $applicant->email;
//        $subject = "Interview Invitation";
//        $txt = '<div class="h2">
//                        <h2>Dear <b>$name</b>,</h2>
//                    <br>
//                        Thank you for applying to <b>Tech Nerds (The Next Idea)</b>.
//                    <br>
//                    <br>
//                        You have been shortlisted for an interview on <b>$date</b>.
//                    <br>
//                    <br>
//                        Address: 140 F1, Johar Town, Lahore. opposite LDA Offices and Behind Lahore Grammar School.
//                    <br>
//                    <br>
//                        Contact # 04235315372
//                    <br>
//                    <br>
//                        Regards,
//                            <br>
//                        Tech Nerds
//                            <br>
//                        https://technerds.com/
//                </div>';
//        $message = str_replace('$name', $name, $txt);
//        $message = str_replace('$date', $date, $message);
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= "From:" . "kash@technerds.com" . "\r\n" .
//            "CC: ishteeaq@gmail.com";
//
//        if (mail($to, $subject, $message, $headers)) {
//            Session::flash('message', 'Email Send Successfully!');
//            Session::flash('alert', 'alert-success');
//            return redirect()->back();
//        } else {
//            Session::flash('message', 'Email Not Send!');
//            Session::flash('alert', 'alert-danger');
//            return redirect()->back();
//        }
//
//
//    }
}
