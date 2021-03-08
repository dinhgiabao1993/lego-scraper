<?php

namespace App\Jobs;

use App\Mails\NewProducts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyNewProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $newProducts;

    public function __construct(array $newProducts)
    {
        $this->newProducts = $newProducts;
    }

    public function handle()
    {
        try {
            Mail::to(env('ALERT_MAIL_RECEIVER', 'kmander@gmail.com'))
                ->send(new NewProducts($this->newProducts, env('ALERT_MAIL_RECEIVER', 'kmander@gmail.com')));
        } catch (\Exception $e) {
            Log::error('NotifyNewProductsJob: ' . $e->getMessage(), $e->getTrace());
        }
    }
}