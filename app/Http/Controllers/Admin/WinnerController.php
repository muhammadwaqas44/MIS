<?php

namespace App\Http\Controllers\Admin;

use App\CallStatus;
use App\Prize;
use App\Services\WinnerServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WinnerController extends Controller
{
    public function allWinners(Request $request, WinnerServices $winnerServices)
    {
        $data['winners'] = $winnerServices->allWinners($request);
        $data['prizes'] = Prize::all();
        $data['statuses'] = CallStatus::where([['module','LiveSessionWinners'],['id','!=',73]])->get();
        return view('admin.user.winner.all-winners', compact('data'));
    }

    public function addWinnerPost(Request $request, WinnerServices $winnerServices)
    {
        $winnerServices->addWinnerPost($request);
        return redirect()->back();
    }

    public function editWinnerPost(Request $request,$winnerId, WinnerServices $winnerServices)
    {
        $winnerServices->editWinnerPost($request, $winnerId);
        return redirect()->back();
    }
}
