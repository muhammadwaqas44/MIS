<?php

namespace App\Http\Controllers\Admin;

use App\Services\PlatFormServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatFormController extends Controller
{
    public function youTubePlatformProcess(Request $request, PlatFormServices $platFormServices)
    {
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '-1');
        ini_set('memory_limit', $normalMemoryLimit);
        $platFormServices->youTubePlatformProcess($request);
        return redirect()->back();
    }

    public function youTubePlatformSEO(Request $request, PlatFormServices $platFormServices)
    {
        $normalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '-1');
        ini_set('memory_limit', $normalMemoryLimit);
        $platFormServices->youTubePlatformSEO($request);
        return redirect()->back();
    }

    public function hisStatusSEO(Request $request, PlatFormServices $platFormServices)
    {
        $platFormServices->hisStatusSEO($request);
        return redirect()->back();
    }

    public function hisStatusProcess(Request $request, PlatFormServices $platFormServices)
    {
        $platFormServices->hisStatusProcess($request);
        return redirect()->back();
    }
}
