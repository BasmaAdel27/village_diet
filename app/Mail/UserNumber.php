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
        $logo = asset('website/assets/images/logo/icon.png');
        $twitter = asset('website/assets/images/footer/twitter.svg');
        $insta = asset('website/assets/images/footer/instagram.svg');
        $tiktok = asset('website/assets/images/footer/tik-tok.svg');

        $subject = app()->getLocale() == 'en' ? "Welcome To Village Diet" : "مرحبا بك في فيلج دايت";
        return $this->view('emails.users.user_number', [
            'user' => $this->user,
            'logo' => $logo,
            'twitter' => $twitter,
            'instagram' => $insta,
            'tiktok' => $tiktok,
        ])
            ->with(['message' => $this])
            ->from("info@thevillagediet.com", "Village Diet")
            ->subject($subject);
    }
}
