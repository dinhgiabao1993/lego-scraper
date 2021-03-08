<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProducts extends Mailable
{
    use Queueable, SerializesModels;

    public $newProducts;
    public $receiverEmail;

    public function __construct(array $newProducts, string $receiverEmail)
    {
        $this->newProducts = $newProducts;
        $this->receiverEmail = $receiverEmail;
    }

    public function build()
    {
        return $this->from(env('ALERT_MAIL_SENDER', 'example@test.com'))
                    ->view('emails.new_products');
    }
}