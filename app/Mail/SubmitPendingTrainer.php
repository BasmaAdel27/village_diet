<?php

namespace App\Mail;

use App\Models\Trainer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitPendingTrainer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Trainer $trainer,$email,$password)
    {
        $this->email=$email;
        $this->password=$password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.pending_trainers.submit')->with(['email'=>$this->email,'password'=>$this->password])
              ->subject("Welcome To Village Diet");    }
}
