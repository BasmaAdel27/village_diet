<?php

namespace App\Mail;

use App\Models\Trainer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeclinePendingTrainer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Trainer $trainer, $reason)
    {
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $logo = asset('website/assets/images/logo/icon.png');
        $twitter = asset('website/assets/images/socials/twitter.png');
        $insta = asset('website/assets/images/socials/instagram.png');
        $tiktok = asset('website/assets/images/socials/tiktok.png');

        $subject = app()->getLocale() == 'en' ? "Welcome To Village Diet" : "مرحبا بك في فيلج دايت";
        return $this->view('emails.pending_trainers.declined', [
              'reason' => $this->reason,
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
