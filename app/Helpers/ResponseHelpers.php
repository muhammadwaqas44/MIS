<?php
/**
 * Created by PhpStorm.
 * User: Waqas Rana
 * Date: 10/18/2019
 * Time: 7:08 PM
 */

namespace App\Helpers;


class ResponseHelpers
{
    public static function jsonResponse($status, $message, $data = [], $error = [], $statuscode = 200)
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data, 'error' => $error], $statuscode);
    }
}