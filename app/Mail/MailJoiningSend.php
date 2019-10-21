<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailJoiningSend extends Mailable
{
    use Queueable, SerializesModels;


    protected $name;
    protected $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $date)
    {
        $this->name = $name;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.offer-joining')
            ->from('hr@technerds.com', 'Tech Nerds')
            ->subject('Welcome to Tech Nerds')
            ->cc('ishteeaq@gmail.com', 'Ishtiaq Haider')
            ->with([
                'name' => $this->name,
                'date' => $this->date,
            ]);
    }
}
