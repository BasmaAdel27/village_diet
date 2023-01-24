<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNumber extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private User $user)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = app()->getLocale() == 'en' ? "Welcome To Village Diet" : "مرحبا بك في فيلج دايت";
        return $this->view('emails.users.user_number', ['user' => $this->user])
            ->with(['message' => $this])
            ->from("info@thevillagediet.com", "Village Diet")
            ->subject($subject);
    }
}
