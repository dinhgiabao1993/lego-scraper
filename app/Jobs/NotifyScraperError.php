<?php

namespace App\Jobs;

use App\Mails\ScraperError;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyScraperError implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $errorMessage;

    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function handle()
    {
        try {
            Mail::to(env('ALERT_MAIL_RECEIVER', 'kmander@gmail.com'))
                ->send(new ScraperError($this->errorMessage, env('ALERT_MAIL_RECEIVER', 'kmander@gmail.com')));
        } catch (\Exception $e) {
            Log::error('NotifiScraperErrorJob: ' . $e->getMessage(), $e->getTrace());
        }
    }
}