<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Mail\SendMailExpenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


//    public function sendMail()
//    {
//        $totalExpenses = Expense::whereRaw('Date(created_at) = CURDATE()')
//            ->get();
//      dd($totalExpenses);
//          $data = $totalExpenses;
//        Mail::send('mail.expensesMail', $totalExpenses, function ($message) {
//            $message->to('vickyrana4433@gmail.com', 'Muhammad Waqas')->subject('Today Expenses');
//        });
//        Mail::to('vickyrana4433@gmail.com')->send(new SendMailExpenses($totalExpenses));
//    }


}
