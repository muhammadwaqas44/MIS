<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 6/25/2019
 * Time: 1:36 PM
 */

namespace App\Services;


use App\SmsLog;

class SMSResponseServices
{
    function __construct()
    {
        $this->messageResponsePagination = 20;
    }

    public function allMessageResponse($request)
    {
        $allMessageResponse= SmsLog::withoutGlobalScopes()->orderBy('id', 'desc')->whereNull('deleted_at');

        if ($request->search_title) {
            $allMessageResponse = $allMessageResponse
                ->where('recipient_no', 'like', '%' . $request->search_title  . '%')
                ->orWhere('body', 'like', '%' . $request->search_title . '%')
                ->orWhere('status', 'like', '%' . $request->search_title . '%')
                ->orWhere('reference', 'like', '%' . $request->search_title . '%')
                ->orWhere('masking', 'like', '%' . $request->search_title . '%');
        }

        $data['responses'] = $allMessageResponse->paginate($this->messageResponsePagination);
        return $data;
    }
}