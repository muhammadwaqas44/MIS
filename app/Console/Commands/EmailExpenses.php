<?php

namespace App\Console\Commands;

use App\Expense;
use App\Mail\SendMailExpenses;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailExpenses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendMail:expenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email for Today Expenses And Funds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalExpensesFunds = Expense::whereRaw('Date(created_at) = CURDATE()')
            ->where('exp_type_id', 1)
            ->get();
        $totalExpensesExp = Expense::whereRaw('Date(created_at) = CURDATE()')
            ->where('exp_type_id', 2)
            ->get();
        $totalExpensesFundsSum = $totalExpensesFunds->sum('amount');
        $totalExpensesExpSum = $totalExpensesExp->sum('amount');

        $qamar_funds = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as count'))
            ->where([['exp_type_id', 1], ['employee_id', 939], ['is_active', 1]])
            ->first();
        $qamar_expense = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as count'))
            ->where([['exp_type_id', 2], ['employee_id', 939], ['is_active', 1]])
            ->first();
        $qamar = $qamar_funds->count - $qamar_expense->count;

        $awais_funds = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as count'))
            ->where([['exp_type_id', 1], ['employee_id', 940], ['is_active', 1]])
            ->first();
        $awais_expense = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as count'))
            ->where([['exp_type_id', 2], ['employee_id', 940], ['is_active', 1]])
            ->first();
        $awais = $awais_funds->count - $awais_expense->count;

        $recipients = [
//            'awaisnazir412@gmail.com',
//            'muhammadqamar2525@gmail.com',
//            'ishteeaq@gmail.com',
//            'syedcashif@gmail.com',
            'vickyrana4433@gmail.com',
            ];
        Mail::to($recipients)->send(new SendMailExpenses($totalExpensesFunds, $totalExpensesFundsSum, $totalExpensesExp, $totalExpensesExpSum, $qamar, $awais));
    }
}
