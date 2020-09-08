<?php

namespace App\Mail;

use App\Model\Cases;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sender extends Mailable
{
    use Queueable, SerializesModels;

    public $case;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cases $case)
    {
        $this->case = $case;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('mail.invitation')->with(['title'  => 'My mail',
                                                     'sidebar'  => $this->case->client_name]);
    }
}
