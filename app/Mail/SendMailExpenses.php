<?php

namespace App\Mail;

use App\Expense;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailExpenses extends Mailable
{
    use Queueable, SerializesModels;

    protected $totalExpensesFunds;
    protected $totalExpensesFundsSum;
    protected $totalExpensesExp;
    protected $totalExpensesExpSum;
    protected $awais;
    protected $qamar;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($totalExpensesFunds, $totalExpensesFundsSum, $totalExpensesExp, $totalExpensesExpSum, $awais, $qamar)
    {
        $this->totalExpensesFunds = $totalExpensesFunds;
        $this->totalExpensesFundsSum = $totalExpensesFundsSum;
        $this->totalExpensesExp = $totalExpensesExp;
        $this->totalExpensesExpSum = $totalExpensesExpSum;
        $this->qamar = $qamar;
        $this->awais = $awais;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.expensesMail')
            ->from('hr@technerds.com','Tech Nerds')
            ->subject('Mail Expenses')
            ->with([
                'totalExpensesFunds' => $this->totalExpensesFunds,
                'totalExpensesFundsSum' => $this->totalExpensesFundsSum,
                'totalExpensesExp' => $this->totalExpensesExp,
                'totalExpensesExpSum' => $this->totalExpensesExpSum,
                'awais' => $this->awais,
                'qamar' => $this->qamar,
            ]);
    }

}
