<?php

namespace App\Mail;

use App\Models\Template\Template;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $email, public Template $template)
    {
    }

    public function build()
    {
        $templateContent = preg_replace(
            ['#@name#', '#@email#'],
            [$this->email, $this->email],
            $this->template['content']
        );

        return $this->subject($this->template['subject'])->view('emails.subscriber_mail', ['templateContent' => $templateContent]);
    }
}
