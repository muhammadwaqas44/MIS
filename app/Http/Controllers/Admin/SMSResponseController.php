<?php

namespace App\Http\Controllers\Admin;

use App\Massege;
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

    public function allMessages(Request $request, SMSResponseServices $responseServices)
    {
        $data['messages'] = $responseServices->allMessages($request);
        return view('admin.message-response.all-messages', compact('data'));
    }

    public function changeMessageStatus($messageId, SMSResponseServices $responseServices)
    {
        $responseServices->changeMessageStatus($messageId);
        return redirect()->back();
    }

    public function addMessage(Request $request, SMSResponseServices $responseServices)
    {
        $responseServices->addMessage($request);
        return redirect()->back();
    }

    public function updateMessage(Request $request, $messageId, SMSResponseServices $responseServices)
    {
        $responseServices->updateMessage($request, $messageId);
        return redirect()->back();
    }
}
