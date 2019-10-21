<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Designation;
use App\EmpHistory;
use App\Exports\AddedApplicantExport;
use App\Exports\HRInterviewsExport;
use App\Exports\InitialInterviewsExport;
use App\Exports\InterviewSchedulesExport;
use App\Exports\JobApplicantExport;
use App\Exports\OfferGivenExport;
use App\Exports\ShortlistedExport;
use App\Exports\TechnicalExport;
use App\JobApplication;
use App\Services\EmpHistoryServices;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
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

    public function addStatusInterview($scheduleId)
    {
        $interview = EmpHistory::where('id', $scheduleId)->first();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Form Fill Status')->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin.hiring.schedule.add', compact('data', 'interview'));
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

    public function allInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allInterviews'] = $empHistoryServices->allInterviews($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Form Fill Status')->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.initial-interview.all-interviews', compact('data'));
    }

    public function interviewDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach || $jobApplication->joining_latter)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->route('admin.all-interviews');
    }

    public function addInitialInterviewStatus($interviewId)
    {
        $interview = EmpHistory::where([['job_id', $interviewId], ['is_active', 1]])->first();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.initial-interview.add', compact('data', 'interview'));
    }

    public function viewInitialInterviewStatus($interviewId)
    {
        $interview = EmpHistory::where('id', $interviewId)->first();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Form Fill Status')->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.initial-interview.view', compact('data', 'interview'));
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

    public function addShortlistedStatus($interviewId)
    {
        $interview = EmpHistory::where([['job_id', $interviewId], ['is_active', 1]])->first();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('short_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.shortlisted.add', compact('data', 'interview'));
    }

    public function viewShortlistedStatus($interviewId)
    {
        $interview = EmpHistory::where('id', $interviewId)->first();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.shortlisted.view', compact('data', 'interview'));
    }

    public function shortlistDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach || $jobApplication->joining_latter)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->route('admin.shortlisted');
    }

    public function allTechInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allTechInterviews'] = $empHistoryServices->allTechInterviews($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('tech_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.technical-interview.tech-interview', compact('data'));
    }

    public function addTechStatus($interviewId)
    {
        $interview = EmpHistory::where([['job_id', $interviewId], ['is_active', 1]])->first();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('tech_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.technical-interview.add', compact('data', 'interview'));
    }

    public function viewTechStatus($interviewId)
    {
        $interview = EmpHistory::where('id', $interviewId)->first();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.technical-interview.view', compact('data', 'interview'));
    }

    public function techDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach || $jobApplication->joining_latter)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->route('admin.tech-interview');
    }

    public function allHRInterviews(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allHRInterviews'] = $empHistoryServices->allHRInterviews($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.hr-interview.hr-interview', compact('data'));
    }

    public function addHRStatus($interviewId)
    {
        $interview = EmpHistory::where([['job_id', $interviewId], ['is_active', 1]])->first();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.hr-interview.add', compact('data', 'interview'));
    }

    public function viewHRStatus($interviewId)
    {
        $interview = EmpHistory::where('id', $interviewId)->first();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.hr-interview.view', compact('data', 'interview'));
    }

    public function hrDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach || $jobApplication->joining_latter)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->route('admin.hr-interview');
    }

    public function allOfferGiven(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allOfferGiven'] = $empHistoryServices->allOfferGiven($request);
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.offer-given.offer-given', compact('data'));
    }

    public function addOfferStatus($interviewId)
    {
        $interview = EmpHistory::where([['job_id', $interviewId], ['is_active', 1]])->first();
        $data['interviewStatusAfterInitial'] = CallStatus::where('module', '=', 'Interview Status')->where('hr_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.offer-given.add', compact('data', 'interview'));
    }

    public function viewOfferStatus($interviewId)
    {
        $interview = EmpHistory::where('id', $interviewId)->first();
        $data['interviewStatus'] = CallStatus::where('module', '=', 'Interview Status')->where('ini_int', 1)->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.offer-given.view', compact('data', 'interview'));
    }

    public function offerDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach || $jobApplication->joining_latter)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->route('admin.offer-given');
    }

    public function allApplicants(Request $request, EmpHistoryServices $empHistoryServices)
    {
        $data['allApplicants'] = $empHistoryServices->allApplicants($request);
        $data['callStatus'] = CallStatus::where([['module', '!=', 'Update Employee'], ['id', '!=', 1], ['id', '!=', 2]])->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        $data['designation'] = Designation::where('id', '!=', 1)->get();
        $data['statuses'] = CallStatus::all();
        return view('admin..hiring.all-applicants.all-applicants', compact('data'));
    }

    public function addAllAppStatus($interviewId)
    {
        $interview = EmpHistory::where([['job_id', $interviewId], ['is_active', 1]])->first();
        $data['callStatus'] = CallStatus::where([['module', '!=', 'Update Employee'], ['id', '!=', 1], ['id', '!=', 2]])->get();
        $data['updatedInterviews'] = EmpHistory::orderBy('id', 'desc')->get();
        return view('admin..hiring.all-applicants.add', compact('data', 'interview'));
    }

    public function applicantsDataPost(Request $request, $scheduleId, EmpHistoryServices $empHistoryServices)
    {
        $schedule = EmpHistory::find($scheduleId);
        $jobApplication = JobApplication::find($schedule->job_id);
        if ($request->emailSend == 1) {
            if ($request->call_id == 14) {
                if (empty($request->file_attach || $jobApplication->joining_latter)) {
                    return 'Please Attach Offer Given Latter..';
                }
            }
        }
        $empHistoryServices->interviewDataPost($request, $scheduleId);
        return redirect()->route('admin.all-applicants');
    }

    public function exportJobApplicant()
    {
        return Excel::download(new JobApplicantExport(), 'Job-Applicants.xlsx');
    }

    public function exportAllSchedules()
    {
        return Excel::download(new InterviewSchedulesExport(), 'All-Schedules.xlsx');
    }

    public function exportAllIniInterviews()
    {
        return Excel::download(new InitialInterviewsExport(), 'All-Initial-Interviews.xlsx');
    }

    public function exportAllHRInterviews()
    {
        return Excel::download(new HRInterviewsExport(), 'All-HR-Interviews.xlsx');
    }

    public function exportAllOfferGiven()
    {
        return Excel::download(new OfferGivenExport(), 'All-Offer-Given.xlsx');
    }

    public function exportAllShortlisted()
    {
        return Excel::download(new ShortlistedExport(), 'All-Shortlisted.xlsx');
    }

    public function exportAllTechInterviews()
    {
        return Excel::download(new TechnicalExport(), 'All-Tech-Interviews.xlsx');
    }

    public function exportAllAddedApplicants()
    {
        return Excel::download(new AddedApplicantExport(), 'All-Added-Applicants.xlsx');
    }

    public function offerLatterCompose(Request $request)
    {
//        dd($request->all());

        $jobApplication = JobApplication::find($request->job_id);

//        $schedule = EmpHistory::where([['job_id', $request->job_id], ['is_active', 1]])->first();
////        dd($schedule);
        if ($jobApplication->is_active == 1) {
            $jobApplication->is_active = 0;
            $jobApplication->save();
        }
        $pdf = PDF::loadView('pdf.offer-latter',
            ['name' => $jobApplication->name,
                'date_now' => Carbon::now()->format("d F Y"),
                'join_date' => Carbon::parse(str_replace('-', '', $request->date))->format("d F Y"),
                "address" => $jobApplication->address,
                'salary_probation' => $request->salary_probation,
                "city" => $jobApplication->city_name,
                'position' => $jobApplication->designation->name,
            ]);
//                    $str = Str::random(6);
        $str = mt_rand(100000, 999999) . time();
//                    $sto=  ImageHelpers::uploadFile('/offer-latter/',$content1, $file);
//                    $sto = Storage::put('/project-assets/files/'.$str.'.pdf', $content1);
//                    $sto = file_put_contents("".$str.".pdf", $pdf->output());
        $sto = $pdf->save(public_path('/offer-latter/' . $str . '.pdf'));
        $path = '/offer-latter/' . $str . '.pdf';
//                    dd($sto,$path);
        if ($jobApplication) {
            $jobApplication->joining_latter = $path;
            $jobApplication->save();
        }

        return response()->json(["data" => $request->all(), 'message' => 'Form Submit Successfully'], 200);
    }

    public function downloadOfferLatter($interviewId)
    {
        $jobApplicant = JobApplication::where('id', $interviewId)->firstOrFail();
        if ($jobApplicant->joining_latter) {
            $file = public_path() . $jobApplicant->joining_latter;
            return response()->download($file);
        } else {
            return 'File Does not Exist';
        }
    }
}
