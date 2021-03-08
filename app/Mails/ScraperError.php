<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScraperError extends Mailable
{
    use Queueable, SerializesModels;

    public $errorMessage;
    public $receiverEmail;

    public function __construct(string $errorMessage, string $receiverEmail)
    {
        $this->errorMessage = $errorMessage;
        $this->receiverEmail = $receiverEmail;
    }

    public function build()
    {
        return $this->from(env('ALERT_MAIL_SENDER', 'example@test.com'))
                    ->view('emails.scraper_error');
    }
}