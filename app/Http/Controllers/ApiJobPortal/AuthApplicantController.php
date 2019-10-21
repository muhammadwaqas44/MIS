<?php

namespace App\Http\Controllers\ApiJobPortal;

use App\Services\AuthApplicantServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthApplicantController extends Controller
{

    public function signUpApplicant(Request $request, AuthApplicantServices $authApplicantServices)
    {
        $data = $authApplicantServices->signUpApplicant($request);
        return $data;
    }

    public function forgetEmailPassword(Request $request, AuthApplicantServices $authApplicantServices)
    {
        $data = $authApplicantServices->forgetEmailPassword($request);
        return $data;
    }

    public function getUserForPasswordReset(Request $request, $userId, AuthApplicantServices $authApplicantServices)
    {
        $data = $authApplicantServices->getUserForPasswordReset($request, $userId);
        return $data;
    }
}
