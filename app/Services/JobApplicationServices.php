<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/13/2019
 * Time: 2:44 PM
 */

namespace App\Services;


use App\Helpers\ImageHelpers;
use App\JobApplication;

class JobApplicationServices
{
    public function jobApplicationsPost($request){
        $record = JobApplication::withoutGlobalScopes()->where('email', '=', $request->email)->first();
        if (!$record) {
            if (!empty($request->resume)) {
                $extension = $request->resume->getClientOriginalExtension();
                $fileName = time() . "-" . 'resume.' . $extension;
                ImageHelpers::uploadFile('/project-assets/files/', $request->file('resume'), $fileName);
                JobApplication::create(array_merge($request->except('_token'), ['resume' => "/project-assets/files/" . $fileName]));
            } else {
                JobApplication::create(array_merge($request->except('_token'), ['is_active' => 1]));
            }
        } else {
            return redirect()->back();
        }
    }

}