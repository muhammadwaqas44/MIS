<?php
/**
 * Created by PhpStorm.
 * Date: 6/25/2019
 * Time: 1:36 PM
 */

namespace App\Services;


use App\Massege;
use App\SmsLog;
use Illuminate\Support\Facades\DB;

class SMSResponseServices
{
    function __construct()
    {
        $this->messageResponsePagination = 20;
    }

    public function allMessageResponse($request)
    {
        $allMessageResponse = SmsLog::withoutGlobalScopes()->orderBy('id', 'desc')->whereNull('deleted_at');

        if ($request->search_title) {
            $allMessageResponse = $allMessageResponse
                ->where('recipient_no', 'like', '%' . $request->search_title . '%')
                ->orWhere('body', 'like', '%' . $request->search_title . '%')
                ->orWhere('status', 'like', '%' . $request->search_title . '%')
                ->orWhere('reference', 'like', '%' . $request->search_title . '%')
                ->orWhere('masking', 'like', '%' . $request->search_title . '%');
        }

        $data['responses'] = $allMessageResponse->paginate($this->messageResponsePagination);
        return $data;
    }

    public function allMessages($request)
    {
        $allMessages = Massege::withoutGlobalScopes()->orderBy('id', 'desc')->whereNull('deleted_at');

        if ($request->search_title) {
            $allMessages = $allMessages
                ->where('title', 'like', '%' . $request->search_title . '%')
                ->orWhere('body', 'like', '%' . $request->search_title . '%');
        }

        $data['messages'] = $allMessages->paginate($this->messageResponsePagination);
        return $data;
    }

    public function changeMessageStatus($messageId)
    {
        $message = Massege::withoutGlobalScopes()->find($messageId);
        if ($message->is_active == 0) {
            $message->is_active = 1;
            $message->save();
        } else {
            $message->is_active = 0;
            $message->save();
        }
    }

    public function addMessage($request)
    {
        DB::beginTransaction();
        try {
            Massege::create(array_merge($request->except('_token'), ['is_active' => 1,]));
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }
    }

    public function updateMessage($request, $messageId)
    {
        DB::beginTransaction();
        try {
            $message = Massege::withoutGlobalScopes()->find($messageId);
            $message->title = $request->title;
            $message->body = $request->body;
            $message->save();
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }

    }
}