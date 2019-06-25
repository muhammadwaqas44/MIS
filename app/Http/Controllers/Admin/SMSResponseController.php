<?php

namespace App\Http\Controllers\Admin;

use App\Services\SMSResponseServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SMSResponseController extends Controller
{
    public function allMessageResponse(Request $request, SMSResponseServices $responseServices)
    {
        $data['responses'] = $responseServices->allMessageResponse($request);
        return view('admin.message-response.all-message-responses', compact('data'));
    }
}
