<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyAgenda extends Mailable
{
    use Queueable, SerializesModels;

    protected $interViewShedule;
    protected $joiningEmployee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($interViewShedule,$joiningEmployee)
    {
        $this->interViewShedule = $interViewShedule;
        $this->joiningEmployee = $joiningEmployee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.daily-agenda') ->from('hr@technerds.com','Tech Nerds')
            ->subject('Daily Agenda | '.Carbon::today()->format("d F Y").'')
            ->with([
                'interViewShedule' => $this->interViewShedule,
                'joiningEmployee' => $this->joiningEmployee,
            ]);
    }
}
