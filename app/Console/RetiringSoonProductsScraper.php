<?php

namespace App\Console;

use App\Jobs\NotifyScraperError;
use App\Models\RetiringSoonProduct;
use App\Services\ScraperServiceInterface;
use App\Services\RetiringSoonProductServiceInterface;
use App\Traits\CurrencyMapper;
use App\Traits\GeneralExceptionRaiser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RetiringSoonProductsScraper extends Command
{
    use CurrencyMapper, GeneralExceptionRaiser;

    protected $signature = 'scrape:retiring_soon_products';
    protected $description = 'Scrape Lego retiring soon products';

    private $scraperService;
    private $productService;

    public function __construct(
        ScraperServiceInterface $scraperService,
        RetiringSoonProductServiceInterface $productService
    ) {
        parent::__construct();
        $this->scraperService = $scraperService;
        $this->productService = $productService;
    }

    public function handle()
    {
        try {
            $scrapedAt = time();
            foreach (RetiringSoonProduct::MARKETPLACES as $marketplace) {
                $this->info("Start scraping for {$marketplace}");
                $scrapedData = $this->scraperService->getAllRetiringSoon($marketplace);
                array_walk($scrapedData, function(&$row) use ($scrapedAt) {
                    $row['scraped_at'] = $scrapedAt;
                    $row['currency'] = self::signToCode($row['currency']) ?:
                        self::raiseGeneralException("Currency sign {$row['currency']} not support");
                });
                $this->productService->bulkUpdateFromScrapedData($scrapedData);
                $this->info("Stop scraping for {$marketplace}");
            }
            $this->productService->markAsOutOfStockIfScrapedBelow(Carbon::createFromTimestamp($scrapedAt));
        } catch (\Exception $e) {
            dispatch(new NotifyScraperError($e->getMessage()));
            throw $e;
        }
    }
}