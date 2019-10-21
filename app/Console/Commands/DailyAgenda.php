<?php

namespace App\Console\Commands;

use App\EmpHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyAgenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:agenda';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail For Daily Agenda';

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
        $date = Carbon::now()->addDays(1);
        $interViewShedule = EmpHistory::
        whereBetween('dateTime', [$date->clone()->startOfDay(), $date->clone()->endOfDay()])
            ->where([['call_id', 3], ['is_active', 1]])
            ->get();
        $joiningEmployee = EmpHistory::
        whereBetween('dateTime', [$date->clone()->startOfDay(), $date->clone()->endOfDay()])
            ->where([['call_id', 14], ['is_active', 1]])
            ->get();

//        dd($interViewShedule,$joiningEmployee);
        $recipients = [
            'awaisnazir412@gmail.com',
            'rajasami718@gmail.com',
            'muhammadqamar2525@gmail.com',
            'ishteeaq@gmail.com',
            'vickyrana4433@gmail.com',
        ];
        if ($interViewShedule->count() > 0 || $joiningEmployee->count() > 0) {
            Mail::to($recipients)->send(new \App\Mail\DailyAgenda($interViewShedule, $joiningEmployee));
        } else {
            return;
        }

    }
}
