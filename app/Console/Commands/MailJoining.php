<?php

namespace App\Console\Commands;

use App\EmpHistory;
use App\Mail\MailJoiningSend;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailJoining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:join';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//    public function handle()
//    {
//        $date = Carbon::now()->addDays(2);
//        $joiningEmployees = EmpHistory::
//        whereBetween('dateTime', [$date->clone()->startOfDay(), $date->clone()->endOfDay()])
//            ->where([['call_id', 14], ['is_active', 1]])
//            ->get();
//        if ($joiningEmployees->count() > 0) {
//            foreach ($joiningEmployees as $employee) {
//                $name = $employee->applicant->name;
//                $mail = $employee->applicant->email;
//                $date = Carbon::parse($employee->dateTime)->format("d F Y");
//                Mail::to($mail, $name)->send(new MailJoiningSend($name, $date));
//            }
//        } else {
//            return;
//        }
//
//    }
}
